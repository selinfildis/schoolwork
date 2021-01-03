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
    public class StudentController : HomeController
    {
        // GET: Student
        public ActionResult Transcript()
        {
            StudentModel model = new StudentModel();
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var result = StudentMethods.GetStudentTranscript(user.StudentID);
            if (result != null)
                model.stu = result;
            return View("Transcript", model);
        }
        public ActionResult Certificate()
        {
            StudentModel model = new StudentModel();
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var result = StudentMethods.GetStudentInfo(user.StudentID);
            if (result != null)
                model.stu = result;
            return View("Certificate", model);
        }
        public ActionResult Grades()
        {
            StudentModel model = new StudentModel();
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var result = StudentMethods.GetStudentCourses(user.StudentID);
            if (result != null)
                model.stu = result;
            return View("Grades", model);
        }
        public ActionResult Schedule()
        {
            StudentModel model = new StudentModel();
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            var result = StudentMethods.GetStudentSchedule(user.StudentID);
            if (result != null)
                model.stu = result;
            return View("StudentSchedule", model);
        }
    }
}