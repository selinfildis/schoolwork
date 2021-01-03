using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApplication1.Database.Methods
{
    public class UserMethods
    {
        public static User Login(string username, string password)
        {
            using(VitaminEntities context = new VitaminEntities())
            {
                var user = context.User.SingleOrDefault(x => x.Username == username & x.Password == password);
                
                return user;
            }
        }
        public static User GetUserInfo(Guid usrid)
        {
            using(VitaminEntities context = new VitaminEntities())
            {
                var user = context.User.SingleOrDefault(x => x.UserID == usrid);
                if (user.EmployeeID != null)
                {
                    var emp = context.Employee.Include("Insurence").SingleOrDefault(x => x.EmployeeId == user.EmployeeID);
                    user.Employee = emp;
                }
                else if (user.StudentID != null)
                {
                    var student = context.Student.SingleOrDefault(x => x.StudentId == user.StudentID);
                    user.Student = student;
                }
                return user;
            }
        }
        public static List<User> GetUsersInDomain(Guid userid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                var user = context.User.SingleOrDefault(x => x.UserID == userid);
                if (user.EmployeeID != null)
                {
                    return context.User.Include("Employee.Company").Where(x => x.EmployeeID != null).ToList();


                }
                else if (user.StudentID != null)
                {
                    
                    var list = context.User.Include("Student").Where(x => x.StudentID != null).ToList();
                    return list;
                }
                else if (user.TeacherId != null)
                {
                    
                    var list = context.User.Include("Student").Where(x => x.StudentID != null).ToList();
                    return list;
                }
                else
                {
                    var emp = context.User.Include("Employee.Company").Where(x=> x.EmployeeID != null).ToList();
                    return emp;
                }


            }
        }
        public static List<Forum> GetForums(Guid userid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                var user = context.User.SingleOrDefault(x => x.UserID == userid);
                if (user.EmployeeID != null)
                {
                    var cid = context.Employee.Include("Company").SingleOrDefault(x => x.EmployeeId == user.EmployeeID);
                    return context.Forum.Where(x=> x.CompanyId == cid.CompanyId).ToList();
                }
                else if (user.StudentID != null)
                {
                    var courses = context.Transcript.Include("Course").Where(x => x.StudentID == user.StudentID).ToList();
                    List<Forum> forum = new List<Forum>();
                    foreach (var course in courses)
                    {
                        forum.Add(context.Forum.SingleOrDefault(x => x.CourseId == course.Course.cid));
                    }
                    return forum;
                }
                return null;
            }
            
        }
        public static void AddForumTopic(Forum forum)
        {
            using(VitaminEntities context = new VitaminEntities())
            {
                context.Forum.Add(forum);
                context.SaveChanges();
            }
        }
        public static List<ForumEntries> GetForumEntries(int forumid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                return context.ForumEntries.Include("User").Where(x => x.ForumId == forumid).ToList();
            }
        }
        public static void AddForumEntry (ForumEntries forumentry)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                context.ForumEntries.Add(forumentry);
                context.SaveChanges();
            }
        }
        public static bool SendMessage(Message msj)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                try
                {
                    context.Message.Add(msj);
                    context.SaveChanges();
                    return true;
                }
                catch (Exception)
                {
                    return false;
                }
                
            }
        }
        public static List<Message> GetIncommingMessages(Guid userid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                return context.Message.Where(x => x.recieverid == userid).OrderBy(x => x.CreateDate).ToList();
            }
        }
        public static List<Message> GetOutgoingMessages(Guid userid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                return context.Message.Where(x => x.senderid == userid).OrderBy(x => x.CreateDate).ToList();
            }
            
        }

        public static List<Resource> GetResources(Guid userid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                var user = context.User.SingleOrDefault(x => x.UserID == userid);
                if (user.EmployeeID != null)
                {
                    var cid = context.Employee.Include("Company").SingleOrDefault(x => x.EmployeeId == user.EmployeeID);
                    return context.Resource.Where(x => x.CompanyId == cid.CompanyId).ToList();
                }
                else if (user.StudentID != null)
                {
                    var courses = context.Transcript.Include("Course").Where(x => x.StudentID == user.StudentID).ToList();
                    List<Resource> resource = new List<Resource>();
                    foreach (var course in courses)
                    {
                        var item = context.Resource.Where(x => x.CourseId == course.cid).ToList();
                        foreach(var element in item)
                            resource.Add(element);
                    }
                    return resource;
                }
                return null;
            }
        }
        public static List<Schedule> GetSchedule(Guid userid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                return context.Schedule.Where(x => x.UserId == userid).ToList();
            }
        }
        public static bool AddUser(User User)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                context.User.Add(User);
                context.SaveChanges();
                return true;
            }
        }
        public static List<Vacation> GetVacationDays(Guid uid)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                return context.Vacation.Where(x => x.UserId == uid).ToList();
            }
        }
        public static bool AddVacationDay(Vacation v)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                context.Vacation.Add(v);
                context.SaveChanges();
                return true;
            }
        }

        public static bool AddSchedule(Schedule v)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                context.Schedule.Add(v);
                context.SaveChanges();
                return true;
            }
        }
    }
 }
