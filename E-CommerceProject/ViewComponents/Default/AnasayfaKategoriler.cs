using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.ViewComponents.Default
{
    public class AnasayfaKategoriler:ViewComponent
    {
        public IViewComponentResult Invoke()
        {
            Context c = new Context();
            var kategoriler = c.Kategoris.Where(x => x.Durum == 1).ToList();
            return View(kategoriler);  
        }
    }
}
