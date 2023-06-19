using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.Controllers
{
    public class SiparisController : Controller
    {

        public IActionResult Index()
        {
            var sepettoplam = TempData["sepettoplam"];
			return View();
        }
        [HttpPost]
        public IActionResult Index(decimal toplam)
        {
            return View();
        }
		[HttpPost]
		public IActionResult FiyatTut(decimal toplam)
        {
            TempData["sepettoplam"] = toplam;
            return RedirectToAction("Index","Siparis");

        }

	}
}
