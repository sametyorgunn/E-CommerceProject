using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;

namespace E_CommerceProject.Models.ContextDosya
{
    public class Context:IdentityDbContext<Kullanici,Rol,int>
    {
        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        {
            optionsBuilder.UseSqlServer("Data Source=SAMET;Initial Catalog=Eticaret;Integrated Security=True;Pooling=False");
        }

        public DbSet<Kategori> Kategoris  { get; set; }
        public DbSet<Urun> Uruns { get; set; }
        public DbSet<Menu> Menus { get; set; }
        public DbSet<MailBulteni> MailBultenis { get; set; }
        public DbSet<Referans> Referans { get; set; }
        public DbSet<SosyalMedya> sosyalMedyas { get; set; }
        public DbSet<CokluResim> CokluResims { get; set; }
        public DbSet<Sepet> Sepets { get; set; }

       
    }
}
