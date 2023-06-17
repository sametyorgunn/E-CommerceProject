using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

namespace E_CommerceProject.ViewComponents.Default
{
    public class AnasayfaSonUrunler:ViewComponent
    {
        public IViewComponentResult Invoke()
        {
            Context c = new Context();
            var sonurunler = c.Uruns.Include(y=>y.Kategori).Where(x => x.Durum == 1).OrderByDescending(x=>x.Id).ToList();
            return View(sonurunler);
        }
    }
}
