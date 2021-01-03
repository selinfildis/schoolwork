using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Newtonsoft.Json;
using System.Data.Entity;
using WebApplication1.Database.Methods;
using WebApplication1.Database;
using WebApplication1.Models;

namespace WebApplication1.Controllers
{
    public class HomeController : Controller
    {
        public User user;
        [HttpGet]
        public ActionResult Index()
        {
            return View("Login");
        }
        [HttpPost]
        public String Login(string username, string password)
        {
            var result = UserMethods.Login(username, password);
            if (result != null)
            {
                Session["User"] = result;
                user = result;

            }
            return JsonConvert.SerializeObject(result, Formatting.Indented);
                
        }
        
    }
}