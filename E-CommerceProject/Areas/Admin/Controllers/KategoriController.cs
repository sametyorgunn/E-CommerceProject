using E_CommerceProject.Models;
using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.Areas.Admin.Controllers
{
    [Area("Admin")]

    public class KategoriController : Controller
    {
        public IActionResult Index()
        {
            using (var c = new Context())
            {
                var kategoriler = c.Kategoris.ToList();
                return View(kategoriler);
            }
        }

        public IActionResult KategoriEkle()
        {
            return View();
        }
        [HttpPost]
        public IActionResult KategoriEkle(Kategori kategori)
       {
            using (var c = new Context())
            {
                c.Kategoris.Add(kategori);
                c.SaveChanges();
                return Redirect("/Admin/Kategori/Index");
            }
        }

        public IActionResult KategoriDuzenle(int id)
        {
            using (var c = new Context())
            {
                var kategori = c.Kategoris.Find(id);
                return View(kategori);
            }
        }

        [HttpPost]
        public IActionResult KategoriDuzenle(Kategori kategori)
        {
            using (var c = new Context())
            {
                c.Kategoris.Update(kategori);
                c.SaveChanges();
                return RedirectToAction("KategoriDuzenle", new {id=kategori.Id});
            }
        }

        public IActionResult KategoriSil(int id)
        {
			using (var c = new Context())
			{
				var kategori = c.Kategoris.Find(id);
                c.Kategoris.Remove(kategori);
                c.SaveChanges();
				return Redirect("Admin/Kategori/Index");
			}
		}


    }
}
