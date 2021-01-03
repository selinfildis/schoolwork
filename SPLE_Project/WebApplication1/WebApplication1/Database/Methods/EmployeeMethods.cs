using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace WebApplication1.Database.Methods
{
    public class EmployeeMethods
    {
        public static Employee GetEmployeeSchedule(Guid? EmployeeId)
        {
            using(VitaminEntities context = new VitaminEntities())
            {
                if(EmployeeId != null)
                {
                    var emp = context.Employee.Include("Schedule").SingleOrDefault(x => x.EmployeeId == EmployeeId);
                    return emp;
                }
                return null;
            }
        }
        public static Employee GetEmployeeInsurance(Guid? EmployeeId)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                if (EmployeeId != null)
                {
                    var emp = context.Employee.Include("Insurence").SingleOrDefault(x => x.EmployeeId == EmployeeId);
                    return emp;
                }
                return null;
            }
        }
        public static Employee GetEmployeeWork(Guid? EmployeeId)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                if (EmployeeId != null)
                {
                    var emp = context.Employee.SingleOrDefault(x => x.EmployeeId == EmployeeId);
                    return emp;
                }
                return null;
            }
        }
        public static Employee GetEmployeeInformation(Guid? EmployeeId)
        {
            using (VitaminEntities context = new VitaminEntities())
            {
                if (EmployeeId != null)
                {
                    var emp = context.Employee.Include("User").Include("Insurence").SingleOrDefault(x => x.EmployeeId == EmployeeId);
                    return emp;
                }
                return null;
            }
        }
    }
}