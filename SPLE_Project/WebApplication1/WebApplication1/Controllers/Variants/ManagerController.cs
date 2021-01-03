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
    public class ManagerController : Controller
    {
        // GET: Manager
        public ActionResult ListAllEmployees()
        {
            ManagerModel model = new ManagerModel();
            User usr = (User)Session["user"];
            ViewBag.User = (User)Session["user"];
            model.emps = ManagerMethod.GetAllEmployees();
            return View("EmployeeList", model);
        }
        public ActionResult RegisterEmployee()
        {
            ViewBag.User = (User)Session["User"];
            User user = (User)Session["User"];
            ViewBag.Company = ManagerMethod.GetCompany((Guid)user.ManagerId);
            return View("AddEmployee");
        }
        public void AddEmployee(String EmployeeName, String Salary, String EmployeeAdress, 
            String Mail, String Phone, String Username, String Password, String CompanyId)
        {
            User user = new User();
            user.FullName = EmployeeName;
            user.Adress = EmployeeAdress;
            user.UserID = Guid.NewGuid();
            user.StudentID = Guid.NewGuid();
            user.Password = Password;
            user.Mail = Mail;
            user.Username = Username;
            user.PhoneNumber = Phone;
            Employee employee = new Employee();
            employee.Salary = Int32.Parse(Salary);
            employee.CompanyId = Guid.Parse(CompanyId);
            employee.EmployeeId = Guid.NewGuid();
            user.EmployeeID = employee.EmployeeId;
            Insurence insurence = new Insurence();
            insurence.InsuranceType = "Full";
            insurence.Status = "Active";
            insurence.StartDate = DateTime.Today;
            insurence.InsuranceID = Guid.NewGuid();
            employee.Insurence.Add(insurence);
            user.Employee = employee;
            
            var result = UserMethods.AddUser(user);
            if (result == true)
            {
                ViewBag.Added = true;
            }
            Response.Redirect("/Teacher/RegisterStudent");

        }
    }
}