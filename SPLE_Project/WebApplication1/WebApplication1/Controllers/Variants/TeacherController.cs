using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WebApplication1.Models;
using WebApplication1.Database;
using WebApplication1.Database.Methods;

namespace WebApplication1.Controllers
{
    public class TeacherController : HomeController
    {
        // GET: Teacher
        public ActionResult ListStudents()
        {
            TeacherModel model = new TeacherModel();
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var result = TeacherMethods.GetStudents(user.TeacherId);
            if (result != null)
                model.teach = result;
            return View("ListStudents", model);
        }
        public ActionResult ListCourses()
        {
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            TeacherModel model = new TeacherModel();
            var result = TeacherMethods.GetCourses(user.TeacherId);
            if (result != null)
                model.teach = result;
            return View("ListCourses", model);
        }
        public ActionResult RegisterStudent()
        {
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            ViewBag.Teacher = TeacherMethods.GetCourses(user.TeacherId);
            return View("AddStudent");
        }
        public void AddStudent(String StudentName, String StudentAdress, String StudentMail, String StudentPhone, String StudentUsername, String Password, String CourseId)
        {
            User user = new User();
            user.FullName = StudentName;
            user.Adress = StudentAdress;
            user.UserID = Guid.NewGuid();
            user.StudentID = Guid.NewGuid();
            user.Password = Password;
            user.Mail = StudentMail;
            user.Username = StudentUsername;
            user.PhoneNumber = StudentPhone;
            Student stu = new Student();
            stu.StudentId = (Guid)user.StudentID;
            stu.GPA = 0;
            Transcript trans = new Transcript();
            trans.cid = Int32.Parse(CourseId);
            trans.GPA = 0;
            trans.Semester = "2018 Fall";
            stu.Transcript.Add(trans);
            user.Student = stu;
            var result = UserMethods.AddUser(user);
            if (result == true) {
                ViewBag.Added = true;
            }
            Response.Redirect("/Teacher/RegisterStudent");
            
        }
    }
}
