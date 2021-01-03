using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApplication1.Database.Methods
{
    public class TeacherMethods
    {
        public static Teacher GetStudents(Guid? TeacherId)
        {
            using(VitaminEntities context = new VitaminEntities())
            {
                if (TeacherId != null)
                {
                    var stu = context.Teacher.Include("Course.Transcript.Student.User").SingleOrDefault(x => x.TeacherId==TeacherId);
                    //var stu = context.Student.Include("Teacher").Include("User").Include("Transcript.Course").(x => x.Transcript.SingleOrDefault(x=> x.Course.Teacher.TeacherId == TeacherId)).ToList();
                    return stu;
                }
                return null;
            }
            
        }
        public static Teacher GetCourses(Guid? TeacherId)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                if (TeacherId != null)
                {
                    var teacher = context.Teacher.Include("Course").SingleOrDefault(x => x.TeacherId == TeacherId);
                    return teacher;
                }
                return null;
            }

        }
        public static void AddCourse(Course course)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                context.Course.Add(course);
                context.SaveChanges();
            }

        }

    }
}