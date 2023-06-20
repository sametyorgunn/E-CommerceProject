using E_CommerceProject.Dtos;
using E_CommerceProject.Models;
using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.ComponentModel;

namespace E_CommerceProject.Controllers
{
    public class SiparisController : Controller
    {

        public IActionResult Index()
        {
            Context c = new Context();
            var username= User.Identity.Name;
            var userid = c.Users.Where(x=>x.UserName==username).Select(y=>y.Id).FirstOrDefault();
            var sepet = c.Sepets.Include(x => x.Urun).Where(x => x.UserId == userid).ToList();
            decimal toplamsepet = 0;
            foreach(var i in sepet)
            {
                toplamsepet += Convert.ToDecimal(i.Urun.indirimliFiyat) * Convert.ToDecimal(i.Adet);
            }
            ViewBag.sepettoplam = toplamsepet;
			return View(sepet);
        }
        [HttpPost]
        public IActionResult Index(SiparisEkleDto dto)
        {
            Context c = new Context();
            var username = User.Identity.Name;
            var userid = c.Users.Where(x=>x.UserName== username).Select(y=>y.Id).FirstOrDefault();
            var sepet = c.Sepets.Where(x => x.UserId == userid).ToList();
            List<Urun> uruns = new List<Urun>();
            foreach(var i in sepet)
            {
                Urun urun = c.Uruns.Where(x => x.Id == i.Id).FirstOrDefault();
                uruns.Add(urun);
            }


            Siparis siparis = new Siparis
            {
                isim = dto.isim,
                soyisim = dto.soyisim,
                Mail = dto.Mail,
                Telefon = dto.Telefon,
                Ulke = dto.Ulke,
                Sehir = dto.Sehir,
                Adres = dto.Adres,
                siparis_notu = dto.siparis_notu,
                odeme_turu = dto.odeme_turu,
                SiparisKodu = dto.SiparisKodu,
                Siparis_toplam = dto.SepetToplam
            };
            c.siparis.Add(siparis);
            c.SaveChanges();
            return RedirectToAction("Index","Siparis");
        }
		//[HttpPost]
		//public IActionResult FiyatTut(decimal toplam)
  //      {
  //          return RedirectToAction("Index","Siparis");
  //      }

	}
}
