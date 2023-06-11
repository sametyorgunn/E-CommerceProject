using E_CommerceProject.Models;
using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.Areas.Admin.Controllers
{
    [Area("Admin")]

    public class UrunController : Controller
    {
        public IActionResult Index()
        {
            return View();
        }


        public IActionResult UrunEkle()
        {
            return View();
        }
        [HttpPost]
        public IActionResult UrunEkle(Urun urun)
        {
            using(var c = new Context())
            {
                c.Uruns.Add(urun);
                c.SaveChanges();
                return Redirect("/Admin/Urun/UrunEkle");
            }
        }
    }
}
