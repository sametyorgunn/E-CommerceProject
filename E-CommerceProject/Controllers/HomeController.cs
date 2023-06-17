using E_CommerceProject.Models;
using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Diagnostics;

namespace E_CommerceProject.Controllers
{
    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;

        public HomeController(ILogger<HomeController> logger)
        {
            _logger = logger;
        }

        public IActionResult Index()
        {
            Context c = new Context();
            var urunlerAnasayfa = c.Uruns.Include(y=>y.Kategori).Where(x => x.AnasayfadaGoster == 1 && x.Durum == 1 &&x.AnasayfadaGoster!=null).ToList();
            return View(urunlerAnasayfa);
        }

        public IActionResult UrunDetay(int id)
        {
            Context c = new Context();
            var urun = c.Uruns.Include(y => y.Kategori).Where(x => x.Durum == 1 && x.Id == id).Include(z=>z.CokluResim).FirstOrDefault();
			return View(urun);
        }

        public IActionResult Urunler(int id)
        {
			Context c = new Context();
            var kategorininUrunleri = c.Uruns.Include(y=>y.Kategori).Where(x=>x.KategoriId==id && x.Durum==1).ToList();
			return View(kategorininUrunleri);
        }

    }
}