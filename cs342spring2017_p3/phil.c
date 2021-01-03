#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#include <errno.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <pthread.h>
#include <string.h>
#include <malloc.h>
#include <sys/time.h>
#include <math.h>

// ****************************************************************************************************
// Definitions, structs, enums etc.
#define NUM_MAX_PHIL 27
#define NUM_MAX_THINK 60000
#define NUM_MAX_EAT 60000
#define NUM_MIN_THINK 1
#define NUM_MIN_EAT 1

typedef enum DistributionTypeEnum
{
  DistributionType_Uniform,
  DistributionType_Exponential
} DistributionTypeEnum;

typedef enum PhilStateEnum
{
  PhilState_Hungry,
  PhilState_Eating,
  PhilState_Thinking
} PhilStateEnum;

typedef struct sPhil
{
  PhilStateEnum state;
  pthread_t thread;
  int id;
  long unsigned int totalHungryTicks;
  long unsigned int stdDeviationOfHungryTicks;
  double timeToThink;
  double timeToEat;
  int eatsRemaining;
  pthread_mutex_t chopstickLeft;
  pthread_mutex_t chopstickRight;
  struct timeval hungryBeginTime;
  struct timeval hungryEndTime;
} sPhil;

// ****************************************************************************************************
// Global variables

// Configuration
double g_minThink;
double g_maxThink;
double g_minEat;
double g_maxEat;
int g_eatCount;
DistributionTypeEnum g_distType;

// Program states
sPhil g_phil[NUM_MAX_PHIL];
int g_numPhilosophers;
// ****************************************************************************************************
// Functions
int getRandom_Uniform(int low, int high)
{
    double temp = rand()/(1.0 + RAND_MAX);
    return (temp * (high - low + 1)) + low;
}

int getRandom_Exponential(int low, int high)
{
    double lambda = (2.0/(low+high));
    double temp = rand()/(1.0 + RAND_MAX);
    double random = -log(1-temp)/lambda;
    if(random < low || random > high)
        random = getRandom_Exponential(low,high);
    return (int)(random);
}

int getRandom(int low, int high)
{
  if (DistributionType_Uniform == g_distType)
    return getRandom_Uniform(low, high);
  else if (DistributionType_Exponential == g_distType)
    return getRandom_Exponential(low, high);

  return low;
}

void* philosopherRoutine(void* arg)
{
  sPhil* pMe = (sPhil*)arg;
  unsigned long int philX1 = 0;
  while (1)
  {

    if (PhilState_Hungry == pMe->state)
    {
      gettimeofday(&pMe->hungryBeginTime,NULL);
      // Attempt to pick two chopsticks together and only together
      int lockResultLeft = pthread_mutex_trylock(&pMe->chopstickLeft);
      int lockResultRight = pthread_mutex_trylock(&pMe->chopstickRight);

      if ((0 == lockResultLeft) && (0 == lockResultRight))
      {
        // I got both chopsticks!
        // Time to eat!
        pMe->state = PhilState_Eating;
      }
      else
      {
        printf("couldn't get both\n");
        // Couldn't take both chopsticks.
        // I need to drop any single chopstick I could pick, so my neighbors can use them
        if (0 == lockResultLeft)
          pthread_mutex_unlock(&pMe->chopstickLeft);

        if (0 == lockResultRight)
          pthread_mutex_unlock(&pMe->chopstickRight);
        sleep(0);
      }
    }
    else if (PhilState_Eating ==  pMe->state)
    {
      printf("Philosopher %d eating\n",pMe->id );
      gettimeofday(&pMe->hungryEndTime,NULL);
      pMe->totalHungryTicks += pMe->hungryEndTime.tv_usec - pMe->hungryBeginTime.tv_usec;
      if(pMe->eatsRemaining == g_eatCount)
      {
          philX1 = pMe->hungryEndTime.tv_usec - pMe->hungryBeginTime.tv_usec ;
      
      }
      else{
      
          pMe->stdDeviationOfHungryTicks += (philX1-(pMe->hungryEndTime.tv_usec - pMe->hungryBeginTime.tv_usec))*(philX1-(pMe->hungryEndTime.tv_usec - pMe->hungryBeginTime.tv_usec));
      }
      sleep(pMe->timeToEat);

      // Did eat one more time
      pMe->eatsRemaining--;

      // Drop both chopsticks
      pthread_mutex_unlock(&pMe->chopstickLeft);
      pthread_mutex_unlock(&pMe->chopstickRight);

      // Now think...
      pMe->state = PhilState_Thinking;

      // I can now re-select eat and think times, maybe?
    }
    else if (PhilState_Thinking == pMe->state)
    {
      printf("Philosopher %d thinking\n",pMe->id );
      sleep(pMe->timeToThink);
      pMe->state = PhilState_Hungry;
      printf("Philosopher %d hungry\n",pMe->id );
    }
    else
    {
      pthread_mutex_unlock(&pMe->chopstickLeft);
      pthread_mutex_unlock(&pMe->chopstickRight);
      break;
    }

    if (0 == pMe->eatsRemaining)
    {
      break;
    }
  }
  return NULL;
}

// ****************************************************************************************************
// Main function
int main(int argc, char **argv)
{
  // ********************************************************************************
  // Read in arguments
  if (8 != argc)
  {
    printf("Usage: phil <philnum> <minthink> <maxthink> <mineat> <maxeat> <dist> <count>\n");
    printf("  <dist> can be: \"uniform\" & \"exponential\". Only lowercase inputs are accepted.\n");
    printf("Number of philiosophers must not exceed 27\n");
    return -1;
  }
  g_numPhilosophers = atoi(argv[1]) ;
  //From ms to s :)
  g_minThink = atoi(argv[2]);
  g_maxThink = atoi(argv[3]);
  g_minEat = atoi(argv[4]);
  g_maxEat = atoi(argv[5]);
  g_eatCount = atoi(argv[7]);

  if(g_numPhilosophers < 1 || g_numPhilosophers > 60)
  {
    printf("Usage: phil <philnum> <minthink> <maxthink> <mineat> <maxeat> <dist> <count>\n");
    printf("Number of philiosophers must be in range [1,27] inclusive");
    return -1;
  }
  if(g_minThink < NUM_MIN_THINK || g_maxThink > NUM_MAX_THINK )
  {
    printf("Usage: phil <philnum> <minthink> <maxthink> <mineat> <maxeat> <dist> <count>\n");
    printf("Thinking time must be in range [1,60000] inclusive");
    return -1;
  }
  if(g_minEat < NUM_MIN_EAT || g_maxEat > NUM_MAX_EAT )
  {
    printf("Usage: phil <philnum> <minthink> <maxthink> <mineat> <maxeat> <dist> <count>\n");
    printf("Eating time must be in range [1,60000] inclusive");
    return -1;
  }
  if (0 == strcmp(argv[6], "uniform"))
  {
    g_distType = DistributionType_Uniform;
  }
  else if (0 == strcmp(argv[6], "exponential"))
  {
    g_distType = DistributionType_Exponential;
  }
  else
  {
    perror("<dist> can be: \"uniform\", \"exponential\". Only lowercase inputs are accepted.\n");
    return -1;
  }
  // ********************************************************************************
  // Generate philosophers
  g_numPhilosophers = (0==(g_numPhilosophers % 2)) ? (g_numPhilosophers + 1) : g_numPhilosophers;
  pthread_mutex_t chopstick[g_numPhilosophers];
  for (int i = 0; i < g_numPhilosophers; ++i)
  {
    pthread_mutex_init(&chopstick[i], NULL);
  }
  for (int i = 0; i < g_numPhilosophers; ++i)
  {
    g_phil[i].state = PhilState_Hungry;
    g_phil[i].totalHungryTicks = 0;
    g_phil[i].stdDeviationOfHungryTicks = 0;
    g_phil[i].timeToThink = getRandom(g_minThink, g_maxThink)/1000;
    g_phil[i].timeToEat = getRandom(g_minEat, g_maxEat)/1000;
    g_phil[i].eatsRemaining = g_eatCount;
    g_phil[i].id = i+1;
    printf("Philosopher %d hungry\n",g_phil[i].id );
    if (0 == i)
      g_phil[i].chopstickLeft = chopstick[g_numPhilosophers - 1];
    else
      g_phil[i].chopstickLeft = chopstick[i - 1];


    if ((g_numPhilosophers - 1) == i)
      g_phil[i].chopstickRight = chopstick[0];
    else
      g_phil[i].chopstickRight = chopstick[i];


    pthread_create(
      &g_phil[i].thread,
      NULL,
      &philosopherRoutine,
      &g_phil[i]
    );
  }
  // Join. Whatever.
  for(int i = 0; i < g_numPhilosophers; ++i)
  {

    if(0 != pthread_join(g_phil[i].thread, NULL))
    {
      printf("error: cannot join thread %d\n", i);
    }

  }

  for (int i = 0; i < g_numPhilosophers; ++i)
  {
    pthread_mutex_destroy(&chopstick[i]);
  }

  for(int i = 0; i < g_numPhilosophers; ++i)
  {
    printf("Philosopher %d duration of hungry state = %lu ms\n",i+1,g_phil[i].totalHungryTicks);
  }
//  printf("Std Deviation \n");
  unsigned long int stdDeviation = 0;
  for(int i = 0; i < g_numPhilosophers ; ++i)
  {
      stdDeviation = g_phil[i].stdDeviationOfHungryTicks/g_numPhilosophers;
      stdDeviation = sqrtl((long double)stdDeviation);
      printf("Phil %d, Standard Deviation: %ld\n",i+1,stdDeviation);
  }

  return 0;

}
