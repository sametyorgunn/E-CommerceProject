using Microsoft.AspNetCore.Identity;

namespace E_CommerceProject.Models
{
    public class Kullanici:IdentityUser<int>
    {
        public string Adi { get; set; }
        public string SoyAdi { get; set; }
    }
}
