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
    }
}
