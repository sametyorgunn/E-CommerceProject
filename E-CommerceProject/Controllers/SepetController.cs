using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

namespace E_CommerceProject.Controllers
{
    public class SepetController : Controller
    {
        public IActionResult Index(int id)
        {
        
            Context c = new Context();
            var urun = c.Uruns.Include(y=>y.Kategori).Where(x=>x.Id == id).FirstOrDefault();
            return View(urun);
        }
    }
}
