#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <sys/vfs.h>
#include <fcntl.h>
#include <time.h>
#include <stdint.h>
#include <dirent.h>
#include <linux/msdos_fs.h>

#define SECTORSIZE 512   //bytes
#define BLOCKSIZE  4096  // bytes - do not change this value

char diskname[48];
int  disk_fd;
char type[10];
unsigned char volumesector[SECTORSIZE];
char filename[10];


int get_sector (unsigned char *buf, int snum)
{
	off_t offset;
	int n;
	offset = snum * SECTORSIZE;
	lseek (disk_fd, offset, SEEK_SET);
	n  = read (disk_fd, buf, SECTORSIZE);
	if (n == SECTORSIZE)
		return (0);
	else {
		printf ("sector number %d invalid or read error.\n", snum);
		exit (1);
	}
}
void print_sector (unsigned char *s)
{
	int i;
	for (i = 0; i < SECTORSIZE; ++i) {
		printf ("%02x ", (unsigned char) s[i]);
		if ((i+1) % 16 == 0)
			printf ("\n");
	}
	printf ("\n");
}
void print_volume_info(){
	get_sector(volumesector, 0);
	struct fat_boot_sector *fat32 = (struct fat_boot_sector*)volumesector;
	//print stuff
	printf("Volume ID: \n");
	for(int i = 0; i < 4; ++i)
		printf("%d",fat32->fat32.vol_id[i]);
	printf("\nVolume Label:");
	for(int i = 0; i < 11; i++)
		printf("%c", fat32->fat32.vol_label[i]);
	printf("\nFile System Type:");
	for(int i = 0; i < 8; i++)
		printf("%c",fat32->fat32.fs_type[i]);
	printf("\nSystem ID: ");	
	for(int i = 0; i < 8; i++)
		printf("%c", fat32->system_id[i]);
	printf("\n # of Sectors: ");
	for(int i = 0; i < 2; i++)
		printf("%d", fat32->sectors[i]);
	printf("\nRoot Cluster:%d \n", fat32->fat32.root_cluster);
	printf("FAT length: %d \n", fat32->fat_length);
}
void print_rootdir(){
	printf("Printing root directory information:\n");
	get_sector(volumesector,0);
	struct fat_boot_sector *fat32 = (struct fat_boot_sector*)volumesector;
	unsigned int cluster = fat32->reserved 
    			+ (unsigned int)(fat32->fats) 
    			* ((fat32->fat32).length);
   	unsigned int root= cluster + ((fat32->fat32).root_cluster - 2) 
    					* (unsigned int)(fat32->sec_per_clus);
    	unsigned char block[BLOCKSIZE];
    	for(int i = 0; i < BLOCKSIZE / SECTORSIZE; i++)
        	get_sector(block + SECTORSIZE * i, root + i);
	struct msdos_dir_entry *dir_entry =  (struct msdos_dir_entry *)block;

	int i = 0; // because this is where the root dir name is
	while((dir_entry+i)->name[0]!= 0x00){ // because there will be at max 50 entries in the root dir
		unsigned char * name;
		printf("%s\n",(char*)((dir_entry+i)->name));
		i++;
	}		
	
} 
void print_block(char* filename){
	get_sector(volumesector,0);
	struct fat_boot_sector *fat32 = (struct fat_boot_sector*)volumesector;
	unsigned int cluster = fat32->reserved + (unsigned int)(fat32->fats) 
    			* ((fat32->fat32).length);
    	unsigned int root= cluster + ((fat32->fat32).root_cluster - 2) 
    					* (unsigned int)(fat32->sec_per_clus);
    	unsigned char block[BLOCKSIZE];
    	for(int i = 0; i < BLOCKSIZE / SECTORSIZE; i++)
        	get_sector(block + SECTORSIZE * i, root + i);
	struct msdos_dir_entry *dir_entry =  (struct msdos_dir_entry *)block;
	int i = 0;
	while((dir_entry+i)->name[0]!= 0x00){
		char name[9], extention[4], full[10];
		strncpy(name, (char*)((dir_entry+i)->name),8);
		strncpy(extention,(char*)((dir_entry+i)->name)+8,3);
		name[8] = '\0';
		extention[3] = '\0';
		for(int i = 7; i > -1 && name[i] == 0x20; i--)
			name[i]='\0';
		for(int i = 3; i > -1 && name[i] == 0x20; i--)
			name[i]='\0';
		strcpy(full,name);
		full[strlen(name)]='.';
		strcpy(full+strlen(name)+1,extention);
		if(strcasecmp(full,filename)==0){
			printf("%s\n",(dir_entry+i)->name);			
			if((dir_entry+i)->size == 0)
				break;
			uint32_t index = ((dir_entry+i)->starthi)*256 + (dir_entry+i)->start;
			while(index != EOF_FAT32){			
				printf("%u : %x\n",index,index);
				unsigned char fileblock[SECTORSIZE];
				get_sector(fileblock,fat32->reserved + index/(SECTORSIZE/sizeof(int32_t)));
				uint32_t *fblock = (uint32_t*)fileblock;
				index = fblock[index % (SECTORSIZE/sizeof(int32_t))];
				
			}
		}

		i++;
	}
}
	


int main(int argc, char *argv[])
{
	if (argc < 4) {
		printf ("wrong usage\n");
		exit (1);
	}

	strcpy (diskname, argv[1]);
	strcpy (type, argv[3]);

        disk_fd = open(diskname, O_RDWR);
	if (disk_fd < 0) {
		printf ("could not open the disk image\n");
		exit (1);
	}

	
	//Printing volume info
	if(0 == strcmp(type, "volumeinfo")){
		print_volume_info();
	}
	//Printing rootdir
	if(0 == strcmp(type, "rootdir")){
		print_rootdir();
	}
	//printing blocks.bin
	if(0 == strcmp(type, "blocks")){
		if(argc < 5){
			printf ("wrong usage, please indicate file.\n");
			exit (1);
		}
		strcpy(filename, argv[4]);
		print_block(filename);
	}
	close (disk_fd);

	return (0);
}
