using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace E_CommerceProject.Migrations
{
    public partial class adet_barkod_urun : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<int>(
                name: "Adet",
                table: "Uruns",
                type: "int",
                nullable: true);

            migrationBuilder.AddColumn<string>(
                name: "Barkod",
                table: "Uruns",
                type: "nvarchar(max)",
                nullable: true);
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "Adet",
                table: "Uruns");

            migrationBuilder.DropColumn(
                name: "Barkod",
                table: "Uruns");
        }
    }
}
