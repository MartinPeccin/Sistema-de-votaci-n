/* Modulo de VOtación Electronica Legislativa
ESP-12E / NodeMcu v1.0-V2 SOC ESP-8266 .
Sensor Tactil TTP223
Display LCD 20x4
Lector RFID (Radio Frequency Identification) RC522
*/
// interrupcion pedido palabra ----------------------
// Set GPIOs for touch pedido palabra
const int botonPalabra = 15;
// pedidoPalabra: Auxiliary variables
boolean pedidoPalabra = false;

// Chequeo si se activa la interrupcion de pedido de palabra
ICACHE_RAM_ATTR void detectsPalabra() {
  Serial.println("TOuch Detection!!!");
  pedidoPalabra = true;
}
// interrupcion pedido palabra ----------------------

/// LCD --------------------------------------------------------------------------
#include <Wire.h> // responsable comunicación interface i2c
#include <LiquidCrystal_I2C.h> // responsable comunicación  display LCD
// Inicializa o display  0x27
//parametro: POSITIVE > > Backligh ACTIVADO | NEGATIVE > > Backlight desACTIVADO
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);
//LiquidCrystal_I2C lcd(0x20,2,1,0,4,5,6,7,3, POSITIVE);

/// LCD --------------------------------------------------------------------------

#include <SPI.h>
#include <MFRC522.h>

constexpr uint8_t RST_PIN = D3;     // Configurable, see typical pin layout above
constexpr uint8_t SS_PIN = D4;     // Configurable, see typical pin layout above

//constexpr uint8_t GPIO_Pin = D8; // defino pin interrupcion

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

String tag=""; // tag de tarjeta RFID

// codigo acceso datos DB//
#include <ESP8266HTTPClient.h>
//si usas esp8266
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <Separador.h> // libreria de separacion de caracteres usado para separar informacion enviada desde el server


Separador s; // variable de separacion de la libreria separacion

const char* ssid    = "xxxxxx"; // Red Wifi
const char* password = "xxxxxx";

String user = "xxxxx";  // user base de datos
String pass = "xxxxxx"; //  pw base de datos


int estado;
String nombre;
int id_usuario;
int habilitar_voto;
int registro_voto;
int positivo;
int registracion=0; // variable indica si hay registro RFID
int print1=0;
int print2=0;
int print3=0;

// codigo acceso datos DB//

int variable=0; //La variable la inicializamos con 0

char letra; // lineas comando via monitor serial
String comando; //- lineas comando via monitor serial
int incomingByte = 0;

#define touchPin  D0 // Pin for capactitive touch sensor voto positivo
#define touchPin1  10 // Pin for capactitive touch sensor voto negativo

// Funcion pedido palabra por solicitud de Interrupcion
void pedidoPalabraInt() //pedido de la palabra
{
Serial.println("Entro en la funcion pedidoPalabra");
Serial.println(id_usuario);
//pedidoPalabra = false;
HTTPClient http;
String datos_a_enviar4 = "user=" + user + "&cod3=" + id_usuario; // Armo variable compuesta "datos_a_enviar" (String)
http.begin("http://xxxxxxx/HCDvoto/PuestoVotacion/esp-pos26.php");        //Indicamos el destino
http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.
int codigo_respuesta4 = http.POST(datos_a_enviar4);

if(codigo_respuesta4>0){
                     Serial.println("Codigo HTTP: " + String(codigo_respuesta4));   //Print return code

                     if(codigo_respuesta4 == 200){
                                          String cuerpo_respuesta4 = http.getString();
                                          //Serial.println("El servidor respondió ▼ ");
                                          Serial.println(cuerpo_respuesta4);
                                           //Serial.println(".....");
                                           //positivo=1;
                                            pedidoPalabra = false;
                     }else{
                          Serial.print("Error enviando POST pedido palabra, código: ");
                          Serial.println(codigo_respuesta4);
                         //variable=0;

                          }
                        }

  }
//------------------INICIO SETUP -------------------------------------------

void setup() {
  Serial.begin(9600);
  // Interrupcion pedido palabra -----------------
  pinMode(botonPalabra, INPUT);
  // Seteo pulsador pin as interrupt, assign interrupt function and set RISING mode
  attachInterrupt(digitalPinToInterrupt(botonPalabra), detectsPalabra, RISING );
  // ----------------
  

  lcd.begin(20, 4); // Setup LCD 16x2
  lcd.print("  Sistema Votacion");
  lcd.setCursor(0, 1);
  lcd.print("       HCD    ");
  SPI.begin(); // Init SPI bus
  rfid.PCD_Init(); // Init MFRC522 modulo RFID
  //pinMode(D8, OUTPUT);
  pinMode(touchPin, INPUT); // defino acceso pin sensor tactil
  pinMode(touchPin1, INPUT); // defino acceso pin sensor tactil
  // ---------------

  WiFi.begin(ssid, password);

  lcd.setCursor(0, 3);
  lcd.print("Conectando...");
  Serial.print("Conectando...");
  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(500);
    Serial.print(".");
  }

  Serial.print("Conectado con éxito, mi IP es: ");
  Serial.println(WiFi.localIP());
  Serial.println("Bienvenida/o al Sistema de Votación HCD Bahía Blanca");
  lcd.setCursor(0, 3);
  lcd.print("Por Favor Registrese");
  Serial.println("Por Favor Registrese - Tarjeta Acceso");
  delay(700);

}


///---------------------------FIN SETUP --------------------------------------------------

void loop() {

//----------- pedido palabra interrupcion ---
  //if(pedidoPalabra) {
    //Serial.println("Se registro Pedido de Palabra - inicio loop -1");
    //pedidoPalabraInt();
    //pedidoPalabra = false;
    //}  

//------------ pedido palabra interrupcion ---
/// Verifico si esta registrada la tarjeta Contactless
if (registracion==0){

                      // ------------------- si no esta registrada verifico si se activa el lector de RFID por la aproximacion de trajeta
                      if ( rfid.PICC_IsNewCardPresent()){

                                                if (rfid.PICC_ReadCardSerial()) {
                                                                for (byte i = 0; i < 4; i++) {
                                                                  tag += rfid.uid.uidByte[i];
                                                                }
                                                                /// leo los primeros cuadro digitos en exadecimal y lso convierto a decimal formando el TAG
                                                                Serial.println(tag);
                                                                lcd.clear();
                                                                lcd.setCursor(0, 0);
                                                                lcd.print("TAG");
                                                                lcd.print(": ");
                                                                lcd.print(tag);

                                                                //tag = ""; // reseteo tag
                                                                rfid.PICC_HaltA(); //
                                                                rfid.PCD_StopCrypto1(); //
                                                            }
                                                //Serial.println(tag);
                                                delay(500);
                                                print1=0;
                                                print2=0;
                                                print3=0;
                                                variable=0;
                                                ///////// Consulto a la BD si el TAG (tarjeta) esta asignada a un usuario del sistema
                                                HTTPClient http;
                                                //
                                                String datos_a_enviar = "user=" + user + "&pass=" + pass + "&tag=" + tag; // Armo variable compuesta "datos_a_enviar" (String)

                                                //http.begin("http://10.3.141.70/Pruebas/esp-pos23.php");        //Indicamos el destino
                                                http.begin("http://xxxxxx/HCDvoto/PuestoVotacion/esp-pos23.php");        //Indicamos el destino
                                                //Mediante el Request a esp-pos23.php consultamos si el TAG de la tarjeta RFID se encuentra registrado y asociado a algun usuario
                                                http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.

                                                int codigo_respuesta = http.POST(datos_a_enviar);   //Enviamos el post pasándole, los datos que queremos enviar. (esta función nos devuelve un código que guardamos en un int)

                                                if(codigo_respuesta>0){
                                                                      Serial.println("Codigo HTTP: " + String(codigo_respuesta));   //Print return code

                                                                      if(codigo_respuesta == 200){
                                                                                        String cuerpo_respuesta = http.getString();
                                                                                        Serial.println("El servidor respondió ▼ ");
                                                                                        Serial.println(cuerpo_respuesta);
                                                                                        Serial.println(".....");
                                                                                        String elemento1 = s.separa(cuerpo_respuesta, ',',0);// toma el primer elemento del string que envia php
                                                                                        String elemento2 = s.separa(cuerpo_respuesta, ',',1);// toma el segundo elemento del string que envia php
                                                                                        String elemento3 = s.separa(cuerpo_respuesta, ',',2);// toma el primer elemento del string que envia php
                                                                                        String elemento4 = s.separa(cuerpo_respuesta, ',',3);// toma el segundo elemento del string que envia php
                                                                                        Serial.println(elemento1);// Apellido Usuario
                                                                                        Serial.println(elemento2);//si esta registrado en BD
                                                                                        Serial.println(elemento3);// ID usuario
                                                                                        Serial.println(elemento4);// Var4 sin uso

                                                                                        estado=elemento2.toInt(); //si esta registrado en BD se asigna valor 1
                                                                                        nombre=elemento1; //Apellido Usuario
                                                                                        id_usuario=elemento3.toInt(); // ID usuario



                                                                      }else{

                                                                              Serial.print("Error enviando POST, código: ");
                                                                              Serial.println(codigo_respuesta);

                                                                            }
                                                  }else{

                                                          Serial.print("Error en consulta al Servidor");

                                                        }
                                                 // Si el usuario esta registrado (Estado=1)se le da bienvenida y se asigna a la variable registarcion=1
                                                if (estado == 1) {
                                                                Serial.println("Acceso Permitido!");
                                                                Serial.print("Bienvenido ");
                                                                Serial.println(nombre);
                                                                lcd.setCursor(0, 1);
                                                                lcd.print(nombre);
                                                                registracion=1; // defino que el usuario  RFID esta registrado
                                                                delay(500);
                                                      }else {
                                                          // EL usuario no se encuentra registrado, se rechaza el acceso
                                                          Serial.println("Acceso Rechazado!");
                                                          Serial.println("Usuario inexistente");
                                                          lcd.setCursor(0, 1);
                                                          lcd.print("Usuario inexistente ");
                                                          tag = ""; // reseteo tag
                                                        }




                                        }







    }else{

                                          //Serial.println("Usuario Ya registrado");
                                          // el usuario se encuentra registrado, verifico si existe un nuevo registro de RFID
                                          if ( rfid.PICC_IsNewCardPresent()){
                                                                          //si existe un nuevo registro, reseteo las variables de registracion
                                                                          registracion=0;
                                                                          tag = ""; // reseteo tag
                                                                        }
                                          //Verifico si hay pedido de la palabra
                                          if(pedidoPalabra) {
                                                    Serial.println("Se registro Pedido de Palabra - verificacion de votacion habilitada - 2");
                                                    pedidoPalabraInt();
                                                  //pedidoPalabra = false;
                                                    
                                          }

                                          // Una vez que se LOGEO COnsulto a Base de datos para saber si la votacion esta habilitada y si el usuario ya voto
                                          HTTPClient http;
                                          String datos_a_enviar2 = "user=" + user + "&pass=" + pass + "&id_user=" + id_usuario; // Armo variable compuesta "datos_a_enviar" (String)

                                          http.begin("http://xxxxxxx/HCDvoto/PuestoVotacion/esp-pos24.php");        //Indicamos el destino
                                          http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.

                                          int codigo_respuesta2 = http.POST(datos_a_enviar2);   //Enviamos el post pasándole, los datos que queremos enviar. (esta función nos devuelve un código que guardamos en un int)



                                          if(codigo_respuesta2>0){
                                                                  //Serial.println("Codigo HTTP: " + String(codigo_respuesta2));   //Print return code

                                                                  if(codigo_respuesta2 == 200){
                                                                    String cuerpo_respuesta2 = http.getString();
                                                                    //Serial.println("El servidor respondió ▼ ");
                                                                    //Serial.println(cuerpo_respuesta2);
                                                                    //Serial.println(".....");
                                                                    String elemento12 = s.separa(cuerpo_respuesta2, ',',0);// toma el primer elemento del string que envia php
                                                                    String elemento22 = s.separa(cuerpo_respuesta2, ',',1);// toma el segundo elemento del string que envia php
                                                                    String elemento32 = s.separa(cuerpo_respuesta2, ',',2);// toma el primer elemento del string que envia php
                                                                    String elemento42 = s.separa(cuerpo_respuesta2, ',',3);// toma el segundo elemento del string que envia php
                                                                    //Serial.print("Habilitar Voto: ");
                                                                    //Serial.println(elemento12);// Voto habilitado
                                                                    //Serial.println(elemento22);//si voto el concejal
                                                                    //Serial.println(elemento32);// nombre usuario
                                                                    //Serial.println(elemento42);// tipo usuario
                                                                    habilitar_voto=elemento12.toInt(); //valor habilitar_voto (Funcion del sistema - habilitacion de voto)
                                                                    registro_voto=elemento22.toInt(); // valor registro_votacion (tabla estado_votacion, campo de registro si voto el usuario)
                                                                    // verifico si esta habilitado el voto y si el usuario ya voto
                                                                  }else{

                                                                    Serial.print("Error enviando POST2, código: ");
                                                                    //variable=0;

                                                                  }
                                          }else{
                                                  Serial.print("Error en consulta al Servidor");
                                                }
                                          // verifico si el voto esta habilitado (habilitar_voto=1)
                                          if (habilitar_voto == 1) {
                                                                    //verifico si el usuario voto (registro_voto=0 todavia no voto)
                                                                    if (registro_voto==0) {
                                                                              variable=0;
                                                                              if (print3==0){
                                                                                        // si el voto esta habilitado y el user no voto imprimo Aviso para que sepa que debe votar
                                                                                        Serial.println("Voto Habilitado - Por Favor realice votación");
                                                                                        lcd.setCursor(0, 2);
                                                                                        lcd.print("Voto Habilitado     ");
                                                                                        lcd.setCursor(0, 3);
                                                                                        lcd.print("Realice su votacion ");
                                                                                        print3=1;
                                                                                      }
                                                                              print1=0;
                                                                              print2=0;
                                                                              // el sistema queda a la espera de la votacion del concejal
                                                                              while(variable == 0){
                                                                                              //Verifico si hay pedido de la palabra
                                                                                              if(pedidoPalabra) {
                                                                                                  Serial.println("Se registro Pedido de Palabra - verificacion pulsar votacion - 3");
                                                                                                  pedidoPalabraInt();
                                                                                                  //pedidoPalabra = false;
                                                                                                }
                                                                                              int touchValue = digitalRead(touchPin); // pulsador voto positivo
                                                                                              int touchValue1 = digitalRead(touchPin1);// pulsador voto negativo
                                                                                              // Si se selecciona algun pulsador
                                                                                              if (touchValue == HIGH || touchValue1 == HIGH  )
                                                                                              {
                                                                                                          if (touchValue == HIGH)
                                                                                                                {positivo=1;}
                                                                                                          else {positivo=2;}

                                                                                                          Serial.println("TOUCHED"); // imprimo aviso de boton pulsado
                                                                                                          variable=1;
                                                                                                        // envio informacion de votacion para actualizar base de datos

                                                                                                          HTTPClient http;
                                                                                                          String datos_a_enviar3 = "user=" + user + "&cod3=" + id_usuario + "&cod4=" + positivo; // Armo variable compuesta "datos_a_enviar" (String)
                                                                                                          // envio los datos de User=usuario base de datos(a futuro permitira fijar restricciones), cod3=id_usuario, cod4=voto positivo o negativp
                                                                                                          http.begin("http://xxxxxxx/HCDvoto/PuestoVotacion/esp-pos25.php");        //Indicamos el destino
                                                                                                          http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.

                                                                                                          int codigo_respuesta3 = http.POST(datos_a_enviar3);

                                                                                                          if(codigo_respuesta3>0){
                                                                                                                        Serial.println("Codigo HTTP: " + String(codigo_respuesta3));   //Print return code

                                                                                                                        if(codigo_respuesta3 == 200){
                                                                                                                                    String cuerpo_respuesta3 = http.getString();
                                                                                                                                    //Serial.println("El servidor respondió ▼ ");
                                                                                                                                    //Serial.println(cuerpo_respuesta3);
                                                                                                                                    //Serial.println(".....");
                                                                                                                                    positivo=1; // modifico variable de registro de votacion
                                                                                                                        }else{

                                                                                                                                    Serial.print("Error enviando POST2, código: ");
                                                                                                                                    Serial.println(codigo_respuesta3);
                                                                                                                                    //variable=0;



                                                                                                                        }

                                                                                                                        http.end();  //libero recursos

                                                                                                          }else{
                                                                                                                Serial.println("Error en la conexión WIFI");
                                                                                                          }



                                                                                              }
                                                                                              else
                                                                                              {
                                                                                                //Serial.println("not touched");
                                                                                              }
                                                                                              delay(500);

                                                                              }
                                                                              Serial.println("Gracias por la votación");
                                                                              lcd.setCursor(0, 2);
                                                                              lcd.print("                    ");
                                                                              lcd.setCursor(0, 3);
                                                                              lcd.print("Gracias por votar   ");
                                                                              if(pedidoPalabra) {
                                                                                  Serial.println("Se registro Pedido de Palabra - luego de votacion - 4");
                                                                                  pedidoPalabraInt();
                                                                                  //pedidoPalabra = false;
                                                                                }
                                                                              delay(2000);

                                                                              ////---- verifico votacion por comando serial

                                                                    }else{
                                                                                //este caso es cuando esta habilitada la votacion y el usuario ya voto
                                                                                if (print1==0){
                                                                                            Serial.println("En espera de Proxima Votación");
                                                                                            lcd.setCursor(0, 2);
                                                                                            lcd.print("En espera de        ");
                                                                                            lcd.setCursor(0, 3);
                                                                                            lcd.print("Proxima Votacion    ");
                                                                                            print1=1;
                                                                                            //variable=0;
                                                                                }
                                                                                if(pedidoPalabra) {
                                                                                    Serial.println("Se registro Pedido de Palabra - luego de votacion - 5");
                                                                                    pedidoPalabraInt();
                                                                                    //pedidoPalabra = false;
                                                                                  }
                                                                                delay(500);
                                                                    }

                                          }else{
                                                      // la votacion no esta habilitada
                                                      if (print2==0){
                                                                    Serial.println("En espera de Proxima Votación");
                                                                    lcd.setCursor(0, 2);
                                                                    lcd.print("En espera de        ");
                                                                    lcd.setCursor(0, 3);
                                                                    lcd.print("Proxima Votacion    ");
                                                                    print2=1;
                                                      }
                                                      if(pedidoPalabra) {
                                                          Serial.println("Se registro Pedido de Palabra - espera nueva votacion - 6");
                                                          pedidoPalabraInt();
                                                          //pedidoPalabra = false;
                                                        }
                                                      delay(500);
                                                      //variable=0;
                                          }


                                    }


}
