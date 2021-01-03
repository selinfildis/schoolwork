using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApplication1.Database.Methods
{
    public class ManagerMethod
    {
        public static List<Employee> GetAllEmployees()
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                var emp = context.Employee.Include("User").Include("Insurence").ToList();
                if (emp != null)
                    return emp;
                return null;
            } 
        }
        public static Manager GetCompany(Guid ManagerId)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                if (ManagerId != null) {
                    var comp = context.Manager.Include("Company").SingleOrDefault(x => x.ManagerId == ManagerId);
                    if (comp != null)
                        return comp;
                }
                return null;
            }
        }
        
    }
}