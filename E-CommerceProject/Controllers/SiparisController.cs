using E_CommerceProject.Dtos;
using E_CommerceProject.Models;
using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;
using System.ComponentModel;

namespace E_CommerceProject.Controllers
{
    public class SiparisController : Controller
    {

        public IActionResult Index()
        {
			return View();
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


            var sepettoplam = HttpContext.Session.GetString("sepettoplam");
            decimal sepet_toplam = Convert.ToDecimal(sepettoplam);
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
                Siparis_toplam = sepet_toplam
                //Urun =  uruns,
            };
            c.siparis.Add(siparis);
            c.SaveChanges();
            return View();
        }
		[HttpPost]
		public IActionResult FiyatTut(decimal toplam)
        {
            HttpContext.Session.SetString("sepettoplam",Convert.ToString(toplam));
            return RedirectToAction("Index","Siparis");

        }

	}
}
