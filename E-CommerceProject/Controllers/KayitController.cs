using E_CommerceProject.Dtos;
using E_CommerceProject.Models;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.Controllers
{
    public class KayitController : Controller
    {
        private readonly UserManager<Kullanici> _kullanicimanager;

        public KayitController(UserManager<Kullanici> kullanicimanager)
        {
            _kullanicimanager = kullanicimanager;
        }

        public IActionResult Index()
        {
            return View();
        }
        [HttpPost]
        public async Task<IActionResult> Index(KayitDto dto)
        {
            if(ModelState.IsValid)
            {
                Kullanici kullanici = new Kullanici
                {
                    Adi= dto.Adi,
                    SoyAdi=dto.Soyadi,
                    Email = dto.Mail,
                    UserName = dto.KullaniciAdi
                   
                    
                };
                var result = await _kullanicimanager.CreateAsync(kullanici, dto.Sifre);
                if(result.Succeeded)
                {
                    return RedirectToAction("Index", "Giris");
                }
                else
                {
                    return View();
                }
            }
            else
            {
                return View();
            }
            
        }
    }
}
