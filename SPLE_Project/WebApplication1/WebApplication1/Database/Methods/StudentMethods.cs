using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApplication1.Database.Methods
{
    public class StudentMethods
    {
        public static Student GetStudentInfo(Guid? StudentId)
        {
            using(VitaminEntities context = new VitaminEntities())
            {
                var stu = context.Student.Include("User").SingleOrDefault(x => x.StudentId == StudentId);
                return stu;
            }
        }
        public static Student GetStudentTranscript(Guid? StudentId)
        {
            using(VitaminEntities context = new VitaminEntities())
            {
                var transcript = context.Student.Include("Transcript.Course").SingleOrDefault(x => x.StudentId == StudentId);
                return transcript;
            }
        }
        public static Student GetStudentCourses(Guid? StudentId)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                var transcript = context.Student.Include("Transcript.Course").SingleOrDefault(x => x.StudentId == StudentId);
                if (transcript != null)
                    transcript.Transcript = transcript.Transcript.Where(x => x.Semester == "Fall").ToList();
                return transcript;
            }
        }
        public static Student GetStudentSchedule(Guid? StudentId)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                var transcript = context.Student.Include("Schedule").SingleOrDefault(x => x.StudentId == StudentId);
                return transcript;
            }
        }
    }
}