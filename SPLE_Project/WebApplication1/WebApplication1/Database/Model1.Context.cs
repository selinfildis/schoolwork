﻿

//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated from a template.
//
//     Manual changes to this file may cause unexpected behavior in your application.
//     Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------


namespace WebApplication1.Database
{

using System;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;


public partial class VitaminEntities : DbContext
{
    public VitaminEntities()
        : base("name=VitaminEntities")
    {

        this.Configuration.LazyLoadingEnabled = false;

    }

    protected override void OnModelCreating(DbModelBuilder modelBuilder)
    {
        throw new UnintentionalCodeFirstException();
    }


    public virtual DbSet<Company> Company { get; set; }

    public virtual DbSet<Course> Course { get; set; }

    public virtual DbSet<Doctor> Doctor { get; set; }

    public virtual DbSet<Employee> Employee { get; set; }

    public virtual DbSet<Forum> Forum { get; set; }

    public virtual DbSet<ForumEntries> ForumEntries { get; set; }

    public virtual DbSet<GovernmentOfficial> GovernmentOfficial { get; set; }

    public virtual DbSet<Insurence> Insurence { get; set; }

    public virtual DbSet<Manager> Manager { get; set; }

    public virtual DbSet<Message> Message { get; set; }

    public virtual DbSet<Resource> Resource { get; set; }

    public virtual DbSet<Retiree> Retiree { get; set; }

    public virtual DbSet<Schedule> Schedule { get; set; }

    public virtual DbSet<Student> Student { get; set; }

    public virtual DbSet<Teacher> Teacher { get; set; }

    public virtual DbSet<Transcript> Transcript { get; set; }

    public virtual DbSet<User> User { get; set; }

    public virtual DbSet<Vacation> Vacation { get; set; }

}

}

