using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.ViewComponents.Default
{
    public class AdminUrunEklemeKategoriListesi:ViewComponent
    {
        public IViewComponentResult Invoke()
        {
            Context c = new Context();
            var kategoriler = c.Kategoris.ToList();
            return View(kategoriler);
        }
    }
}
