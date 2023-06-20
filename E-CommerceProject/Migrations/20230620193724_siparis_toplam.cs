using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace E_CommerceProject.Migrations
{
    public partial class siparis_toplam : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<decimal>(
                name: "Siparis_toplam",
                table: "siparis",
                type: "decimal(18,2)",
                nullable: false,
                defaultValue: 0m);
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "Siparis_toplam",
                table: "siparis");
        }
    }
}
