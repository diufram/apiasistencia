import 'dart:convert';

List<ServicioToTallers> servicioToTallersFromJson(String str) =>
    List<ServicioToTallers>.from(
        json.decode(str).map((x) => ServicioToTallers.fromJson(x)));

String servicioToTallersToJson(List<ServicioToTallers> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class ServicioToTallers {
  String nombre;
  String precio;

  ServicioToTallers({
    required this.nombre,
    required this.precio,
  });

  factory ServicioToTallers.fromJson(Map<String, dynamic> json) =>
      ServicioToTallers(
        nombre: json["nombre"],
        precio: json["precio"],
      );

  Map<String, dynamic> toJson() => {
        "nombre": nombre,
        "precio": precio,
      };
}
