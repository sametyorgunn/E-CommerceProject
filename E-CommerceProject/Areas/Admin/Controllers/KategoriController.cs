using Microsoft.AspNetCore.Mvc;

namespace E_CommerceProject.Areas.Admin.Controllers
{
    [Area("Admin")]

    public class KategoriController : Controller
    {
        public IActionResult Index()
        {
            return View();
        }
    }
}
