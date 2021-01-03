using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using WebApplication1.Database;

namespace WebApplication1.Models
{
    public class TeacherModel
    {
        public Teacher teach = new Teacher();
        public List<Student> stus = new List<Student>();

    }
}