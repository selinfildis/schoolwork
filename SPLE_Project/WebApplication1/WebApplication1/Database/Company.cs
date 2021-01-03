
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
    using System.Collections.Generic;
    
public partial class Company
{

    [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2214:DoNotCallOverridableMethodsInConstructors")]
    public Company()
    {

        this.Employee = new HashSet<Employee>();

        this.Forum = new HashSet<Forum>();

        this.Manager = new HashSet<Manager>();

        this.Resource = new HashSet<Resource>();

    }


    public System.Guid CompanyId { get; set; }

    public string CompanyName { get; set; }

    public Nullable<System.DateTime> CompanyInitYear { get; set; }



    public virtual Company Company1 { get; set; }

    public virtual Company Company2 { get; set; }

    [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]

    public virtual ICollection<Employee> Employee { get; set; }

    [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]

    public virtual ICollection<Forum> Forum { get; set; }

    [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]

    public virtual ICollection<Manager> Manager { get; set; }

    [System.Diagnostics.CodeAnalysis.SuppressMessage("Microsoft.Usage", "CA2227:CollectionPropertiesShouldBeReadOnly")]

    public virtual ICollection<Resource> Resource { get; set; }

}

}