using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace E_CommerceProject.Migrations
{
    public partial class coklu_Resim_table : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "CokluResims",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    ResimYol = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_CokluResims", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "MailBultenis",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Mail = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_MailBultenis", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "Referans",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Adi = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    ResimYol = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Referans", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "sosyalMedyas",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Sosyalmedya1 = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Sosyalmedya2 = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Sosyalmedya3 = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Sosyalmedya4 = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Sosyalmedya5 = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_sosyalMedyas", x => x.Id);
                });
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "CokluResims");

            migrationBuilder.DropTable(
                name: "MailBultenis");

            migrationBuilder.DropTable(
                name: "Referans");

            migrationBuilder.DropTable(
                name: "sosyalMedyas");
        }
    }
}
