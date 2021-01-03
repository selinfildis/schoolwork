using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Newtonsoft.Json;
using WebApplication1.Controllers;
using WebApplication1.Models;
using WebApplication1.Database;
using WebApplication1.Database.Methods;


namespace WebApplication1.Controllers
{
    public class UserController : HomeController
    {
        
        [HttpGet]
        public ActionResult MainPage()
        {
            ViewBag.User = (User)Session["User"];
            return View("Index");
        }
        public ActionResult PersonalInfo()
        {
            ViewBag.User = (User)Session["User"];
            return View("PersonalInfo");
        }
        public ActionResult Settings()
        {
            ViewBag.User = (User)Session["User"];
            return View("Settings");
        }
        public ActionResult ListForums()
        {
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var result = UserMethods.GetForums(user.UserID);
            ViewBag.Forums = result;
            return View("Forums");
        }
        public ActionResult ListForumEntries(int forumid)
        {
            ViewBag.User = (User)Session["User"];
            var result = UserMethods.GetForumEntries(forumid);
            ViewBag.ForumContent = result;
            return View("ForumTopic");
        }
        public ActionResult Schedule(string uid = null)
        {
            if (uid == null)
            {
                User user = (User)Session["User"];
                ViewBag.User = (User)Session["User"];
                ViewBag.ScheduleList = UserMethods.GetSchedule(user.UserID);
                return View("Schedule");
            }
            
        }
        public string AddSchedule(Schedule sc)
        {
            var result = UserMethods.AddSchedule(sc);
            return JsonConvert.SerializeObject(result, Formatting.Indented);
        }
        public string AddVacationDay(Vacation vac)
        {
            var result = UserMethods.AddVacationDay(vac);
            return JsonConvert.SerializeObject(result, Formatting.Indented);

        }
        public ActionResult VacationDays()
        {
            User user = (User)Session["User"];
            ViewBag.User = (User)Session["User"];
            ViewBag.VacationDay = UserMethods.GetVacationDays(user.UserID);
            return View("VacationDays");
        }
        public ActionResult Inbox()
        {
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var income = UserMethods.GetIncommingMessages(user.UserID);
            var outgone = UserMethods.GetIncommingMessages(user.UserID);
            if (income != null)
                ViewBag.IncommingMessages = income;
            if (outgone != null)
                ViewBag.OutgoingMessages = outgone;
            return View("Inbox");
        }
        public ActionResult Resources()
        {
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            ViewBag.Resources = UserMethods.GetResources(user.UserID);
            return View("Resources");
        }
        public ActionResult ListUsers()
        {
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var userList = UserMethods.GetUsersInDomain(user.UserID);
            ViewBag.ScheduleList = UserMethods.GetSchedule(user.UserID);
            if (userList != null)
                ViewBag.UserList = userList;
            return View("List");
        }
        public ActionResult ViewCV(string uid = null)
        {
            if(uid == null)
            {
                ViewBag.User = (User)Session["User"];
                User user = (User)Session["User"];
                return View("CV");
            }
          
        }
        public PartialViewResult GetMessageScreen(string uid = null)
        {
            ViewBag.User = (User)Session["User"];
            ViewBag.RecieverId = uid;
            return PartialView("_Message");
        }
        public String SendMessage ( string uidreciever, string message)
        {
            User user = (User)Session["User"];
            Message mes = new Message();
            mes.senderid = user.UserID;
            mes.recieverid = Guid.Parse(uidreciever);
            mes.message1 = message;
            mes.CreateDate = DateTime.Now;
            var result = UserMethods.SendMessage(mes);
            return JsonConvert.SerializeObject(result, Formatting.Indented);

        }
        public void FillDB()
        {

            String[] ArrayOfNames =
            {
                "Chayndunth, Lord Of The Brown",
                "Gayzzur, The White",
                "Bimroi, The Taker Of Life",
                "Qonnu, The Dead",
                "Churso, The Fast One",
                "Baethe, The Bunny Killer",
                "Chuvoa, The Protective",
                "Ovnanoal, The Protective",
                "Dunneintei, The Grumpy",
                "Peorlirrath, The Bright",
                "Dundeonth, The Squeeler",
                "Sedath, The Redeemer",
                "Zeovae, The Barbarian",
                "Deirma, Champion Of The Brown",
                "Golryr, The Victorious",
                "Cygiorth, Lord Of Ice",
                "Dundit, Destroyer Of Life",
                "Quvurriet, The Strong Minded",
                "Aezzyrun, Champion Of The Skies",
                "Eoludoalth, Protector Of The Forest",
                "Ilrie, The Puny",
                "Ziassut, The Calm",
                "Qeidraylth, Braveheart",
                "Diarleith, Giver Of Life",
                "Eige, The Fierce",
                "Fryzzoal, The Rabbit Slayer",
                "Todruss, The Grumpy",
                "Zeovniassaet, The Strong",
                "Arsonieth, The Hungry",
                "Qayveiral, The Evil One",
                "Ierrath, Eater Of All",
                "Naylass, Lord Of The White",
                "Oldrun, The Jealous One",
                "Xeiphael, The Dark One",
                "Tiolraylth, The Firestarter",
                "Vizyth, Champion Of The Green",
                "Uzzog, The Tall",
                "Nandrunioss, The Eternal",
                "Sunnoidurth, Champion Of The Skies",
                "Moanoarroanth, The Dark",
                "Caghad, The Clean",
                "Rayghianth, The Puny",
                "Tiallienth, The White One",
                "Aevraynth, The Kind",
                "Mayllerth, The Gifted",
                "Sumath, The Taker Of Life",
                "Ova, Lord Of The Black",
                "Qurmuryt, Redeemer Of Men",
                "Xuziedait, The Brave",
                "Pemorriolth, The Creep"
            };
            String[] array_of_addresses =
            {
                "663 East Hilltop Road Webster, NY 14580",
                "690 Highland St. Garden City, NY 11530",
                "36 Central Ave. Pueblo, CO 81001",
                "544 Halifax Ave. Amityville, NY 11701",
                "653 Sunnyslope Road Erlanger, KY 41018",
                "876 Harvey Dr. Fremont, OH 43420",
                "21 Longfellow Ave.Kansas City, MO 64151",
                "7975 Spruce Road Danbury, CT 06810",
                "414 Pulaski St. Hyde Park, MA 02136",
                "8800 Acacia Street Lake Zurich, IL 60047",
                "39 Manor Dr. Evanston, IL 60201",
                "304 Ryan Drive Lansdowne, PA 19050",
                "4 Briarwood Street Palos Verdes Peninsula, CA 90274",
                "8165 Buttonwood St. Mount Holly, NJ 08060",
                "9057 Brewery Lane Staunton, VA 24401",
                "7355 Mayfield Ave. Irwin, PA 15642",
                "9 South Cherry Hill Street East Elmhurst, NY 11369",
                "15 Wild Rose Dr. Florence, SC 29501",
                "7288 Sheffield St. Stow, OH 44224",
                "375 Arcadia St. Cranberry Twp, PA 16066",
                "895 Brickyard Court Reisterstown, MD 21136",
                "626 Tarkiln Hill Lane Buckeye, AZ 85326",
                "9437 Ryan Rd. Elkhart, IN 46514",
                "461 Central Court Brockton, MA 02301",
                "27 Cedar Lane Waltham, MA 02453",
                "55 Bohemia St. Goshen, IN 46526",
                "900 Oakwood Street Algonquin, IL 60102",
                "88 Beacon St. Roselle, IL 60172",
                "754 Cooper Drive Loxahatchee, FL 33470",
                "7754 Cedarwood Ave. Coram, NY 11727",
                "8813 Clark Court Lake Mary, FL 32746",
                "29 Cherry Hill Court Sacramento, CA 95820",
                "375 Tunnel Dr. Livingston, NJ 07039",
                "9015 Buttonwood Court Coram, NY 11727",
                "799 Elizabeth Drive Parlin, NJ 08859",
                "79 Old York Ave. Largo, FL 33771",
                "451 Cedar St. Benton Harbor, MI 49022",
                "9612 Bridle Lane Peachtree City, GA 30269",
                "8 Belmont St. Hopkinsville, KY 42240",
                "7 Arnold Ave. Merrillville, IN 46410",
                "956 SW. Oklahoma St. Howard Beach, NY 11414",
                "35 Miles Avenue Mableton, GA 30126",
                "85 North Overlook Dr. Raeford, NC 28376",
                "727 Orange Drive El Paso, TX 79930",
                "76 Golf Dr. El Paso, TX 79930",
                "9261 Myrtle Lane Eden Prairie, MN 55347",
                "36 Morris Street Murrells Inlet, SC 29576",
                "9069 Plymouth St.Randallstown, MD 21133",
                "28 Taylor Lane Enfield, CT 06082",
                "54 Rocky River St. Goose Creek, SC 29445"
            };
            String[] course_name_arr = {
                "Terraforming",
                "Alien Environmental Development",
                "Alien Finance",
                "Alien Anthropology",
                "Alien Martial Arts",
                "Audiology",
                "Planetary Survival",
                "Small Forces Strategy",
                "Alchemy",
                "Alien Biosecurity",
                "Galactic Diplomacy",
                "Foreign Life Science",
                "Alien Sociology",
                "Physical Science",
                "Divining",
                "Alien Social Studies",
                "Elemental Magic",
                "Alien Life Science",
                "Foreign Criminal Justice",
                "Planetary Oceanography",
                "Space Travel",
                "Planetary Chemistry",
                "Nutrition",
                "Alien Medical Physics",
                "Alien Nutrition",
                "Enhanced Therapy",
                "Foreign Social Studies",
                "Planetary Chemistry",
                "Alien P.E.",
                "Foreign Dance",
                "Magic Law",
                "Earth Science",
                "Alien Ethics",
                "Alien Statistics",
                "Charm Casting",
                "Monster Hunting",
                "Curse Creation",
                "Terraforming",
                "Alien Family Psychology",
                "Alien Musical Arts"

            };
            for (var i = 0; i < 50; i++)
            {
                Random rnd = new Random();
                User user = new User();
                user.FullName = ArrayOfNames[rnd.Next(0, 50)];
                user.Adress = array_of_addresses[rnd.Next(0, 50)];
                user.UserID = Guid.NewGuid();
                user.StudentID = Guid.NewGuid();
                user.Password = "pass" + rnd.Next(0, 500);
                user.Mail = rnd.Next(0, 500) + "@mail.com";
                user.Username = "user" + rnd.Next(0, 500);
                user.PhoneNumber = "" + rnd.Next(100000000, 999999999);
                Student stu = new Student();
                stu.StudentId = (Guid)user.StudentID;
                stu.GPA = 0;
                Transcript trans = new Transcript();
                trans.cid = 1;
                trans.GPA = 0;
                trans.Semester = "2018 Fall";
                stu.Transcript.Add(trans);
                user.Student = stu;
                UserMethods.AddUser(user);
            }
            for (var i = 0; i < 50; i++)
            {
                Random rnd = new Random();
                User user = new User();
                user.FullName = ArrayOfNames[rnd.Next(0, 50)];
                user.Adress = array_of_addresses[rnd.Next(0, 50)];
                user.UserID = Guid.NewGuid();
                user.EmployeeID = Guid.NewGuid();
                user.Password = "pass" + rnd.Next(500, 1000);
                user.Mail = rnd.Next(500, 1000) + "@mail.com";
                user.Username = "user" + rnd.Next(500, 1000);
                user.PhoneNumber = "" + rnd.Next(100000000, 999999999);
                Employee employee = new Employee();
                employee.Salary = rnd.Next(5000,10000);
                employee.CompanyId = Guid.Parse("7895cf05-aced-494b-9889-b42b0bf761ca");
                employee.EmployeeId = (Guid)user.EmployeeID;
                Insurence insurence = new Insurence();
                insurence.InsuranceType = "Full";
                insurence.Status = "Active";
                insurence.StartDate = DateTime.Today;
                insurence.InsuranceID = Guid.NewGuid();
                employee.Insurence.Add(insurence);
                user.Employee = employee;
                UserMethods.AddUser(user);
            }
            for (int i = 0; i < 40; i++)
            {
                Random rnd = new Random();
                Course course = new Course();
                course.cid = i+2;
                course.TeacherId = Guid.Parse("c6e66151-6b4f-4b43-a7e1-bfdb2bcbe246");
                course.CourseName = course_name_arr[i];
                TeacherMethods.AddCourse(course);
            }

        }
    }
}
