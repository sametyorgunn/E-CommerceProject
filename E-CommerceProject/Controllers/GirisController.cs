using E_CommerceProject.Dtos;
using E_CommerceProject.Models;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.Controllers
{
    public class GirisController : Controller
    {
        private readonly SignInManager<Kullanici> _signInManager;

		public GirisController(SignInManager<Kullanici> signInManager)
		{
			_signInManager = signInManager;
		}

		public IActionResult Index()
        {
            return View();
        }
        [HttpPost]
        public async Task <IActionResult> Index(GirisDto dto)
        {
            if (ModelState.IsValid)
            {
                var giris = await _signInManager.PasswordSignInAsync(dto.KullaniciAdi, dto.Sifre, true, false);
                if(giris.Succeeded)
                {
                    return RedirectToAction("Index","Profil");
                }
                else
                {
                    return View();
                }
            }
            return View();
        }
    }
}
