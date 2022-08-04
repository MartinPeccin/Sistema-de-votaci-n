
/* Read RFID Tag with RC522 RFID Reader
    Made by miliohm.com
*/
// interrupcion pedido palabra ----------------------
// Set GPIOs for touch pedido palabra
const int botonPalabra = 15;
// pedidoPalabra: Auxiliary variables
boolean pedidoPalabra = false;

// Checks if motion was detected, sets LED HIGH and starts a timer
ICACHE_RAM_ATTR void detectsPalabra() {
  Serial.println("TOuch Detection!!!");
  pedidoPalabra = true;
  }
// interrupcion pedido palabra ----------------------

// interrupcion logout  ----------------------
// Set GPIOs for touch logout
//const int botonLogout = 16;
// logout: Auxiliary variables
//boolean pedidoLogout = false;

// Checks if motion was detected, sets LED HIGH and starts a timer
/*ICACHE_RAM_ATTR void detectsLogout() {
  Serial.println("Logout Detection!!!");
  pedidoLogout = true;
  }*/
// interrupcion pedido palabra ----------------------


/// LCD --------------------------------------------------------------------------
#include <Wire.h> // responsável pela comunicação com a interface i2c
#include <LiquidCrystal_I2C.h> // responsável pela comunicação com o display LCD
// Inicializa o display no endereço 0x27
//os demais parâmetros, são necessários para o módulo conversar com o LCD
//porém podemos utilizar os pinos normalmente sem interferência
//parâmetro: POSITIVE > > Backligh LIGADO | NEGATIVE > > Backlight desligado
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


const char* ssid    = "xxxxxxx"; // Red Wifi
const char* password = "xxxxxxx";

String user = "martin";  // user base de datos
String pass = "xxxxxxxxx"; //  pw base de datos


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

#define touchPin  D0 // Pin for capactitive touch sensor
#define touchPin1  10 // Pin for capactitive touch sensor




void setup() {
  Serial.begin(9600);
  // Interrupcion pedido palabra -----------------
  pinMode(botonPalabra, INPUT);
  // Set motionSensor pin as interrupt, assign interrupt function and set RISING mode
  attachInterrupt(digitalPinToInterrupt(botonPalabra), detectsPalabra, RISING );
  // ----------------
  // Interrupcion logout -----------------
  //pinMode(botonLogout, INPUT);
  // Set motionSensor pin as interrupt, assign interrupt function and set RISING mode
  //attachInterrupt(digitalPinToInterrupt(botonLogout), detectsLogout, RISING );
  //  -----------------

  
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

  


void loop() {

  //----------- pedido palabra interrupcion ---
  if(pedidoPalabra) {
    Serial.println("Se registro Pedido de Palabra");    
    pedidoPalabra = false;
  }
  /*if(pedidoLogout) {
    Serial.println("Se registro Pedido de Logout");    
    pedidoLogout = false;
    
  }*/
  
  //------------ pedido palabra interrupcion ---

if (registracion==0){

  // -------------------
  if ( rfid.PICC_IsNewCardPresent()){
    
  if (rfid.PICC_ReadCardSerial()) {
    for (byte i = 0; i < 4; i++) {
      tag += rfid.uid.uidByte[i];
    }
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
   
   HTTPClient http;
      String datos_a_enviar = "user=" + user + "&pass=" + pass + "&tag=" + tag; // Armo variable compuesta "datos_a_enviar" (String)

      http.begin("http://xxxxxx/HCDvoto/PuestoVotacion/esp-pos23.php");        //Indicamos el destino  
       
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
      
          estado=elemento2.toInt(); //si esta registrado en BD
          nombre=elemento1; //Apellido Usuario
          id_usuario=elemento3.toInt(); // ID usuario




      }else{

       Serial.print("Error enviando POST, código: ");
       Serial.println(codigo_respuesta);

      }
    }else{

       Serial.print("Error en consulta al Servidor");

      }
    
    if (estado == 1) {
                  Serial.println("Acceso Permitido!");
                  Serial.print("Bienvenido ");
                  Serial.println(nombre); 
                  lcd.setCursor(0, 1);                  
                  lcd.print(nombre);
                  registracion=1; // defino que el usuario  RFID esta registrado
                  delay(500);
    }else {
      
      Serial.println("Acceso Rechazado!");
      Serial.println("Usuario inexistente");
      lcd.setCursor(0, 1);                  
      lcd.print("Usuario inexistente ");
      tag = ""; // reseteo tag
    }
   
   
   
    
   
  }
  
  
  
  
  
  
  
}else{
  
  //Serial.println("Usuario Ya registrado");
  if ( rfid.PICC_IsNewCardPresent()){
    registracion=0;
    tag = ""; // reseteo tag
    
    }
  HTTPClient http;
    String datos_a_enviar2 = "user=" + user + "&pass=" + pass + "&id_user=" + id_usuario; // Armo variable compuesta "datos_a_enviar" (String)
            
            http.begin("http://xxxxxx/HCDvoto/PuestoVotacion/esp-pos24.php");        //Indicamos el destino          
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
                      habilitar_voto=elemento12.toInt();
                      registro_voto=elemento22.toInt();
                      // verifico si esta habilitado el voto y si el usuario ya voto 
                      // verifico si esta habilitado el voto y si el usuario ya voto 
          }else{
                                                  
                                                         Serial.print("Error enviando POST2, código: ");                                                        
                                                         //variable=0;
                                                         
                                                         
                                                  
                                                        }
          }else{
          Serial.print("Error en consulta al Servidor");
          }
            if (habilitar_voto == 1) {
                        if (registro_voto==0) {
                        variable=0;
                        if (print3==0){
                        Serial.println("Voto Habilitado - Por Favor realice votación");                        
                        lcd.setCursor(0, 2);                  
                        lcd.print("Voto Habilitado     ");
                         lcd.setCursor(0, 3);
                        lcd.print("Realice su votacion ");
                         print3=1;
                        }
                        print1=0;
                        print2=0;
                       
                        while(variable == 0){
                        int touchValue = digitalRead(touchPin);
                        int touchValue1 = digitalRead(touchPin1);
                        
                                if (touchValue == HIGH || touchValue1 == HIGH  )
                                {
                                  if (touchValue == HIGH)
                                      {positivo=1;}
                                      else {positivo=2;
                                      }
                                  Serial.println("TOUCHED");
                                  variable=1;
                                  //positivo=1;

                                  HTTPClient http;
                                  String datos_a_enviar3 = "user=" + user + "&cod3=" + id_usuario + "&cod4=" + positivo; // Armo variable compuesta "datos_a_enviar" (String)
            
                                  http.begin("http://xxxxxx/HCDvoto/PuestoVotacion/esp-pos25.php");        //Indicamos el destino          
                                  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.
                            
                                  int codigo_respuesta3 = http.POST(datos_a_enviar3);

                                  if(codigo_respuesta3>0){
                                                          Serial.println("Codigo HTTP: " + String(codigo_respuesta3));   //Print return code
                                                  
                                                          if(codigo_respuesta3 == 200){
                                                            String cuerpo_respuesta3 = http.getString();
                                                            //Serial.println("El servidor respondió ▼ ");
                                                            //Serial.println(cuerpo_respuesta3);
                                                            //Serial.println(".....");
                                                            positivo=1;
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
                        delay(2000);

                     ////---- verifico votacion por comando serial 
                                             
                        }else{
                          if (print1==0){
                          Serial.println("En espera de Proxima Votación");
                          lcd.setCursor(0, 2);                  
                          lcd.print("En espera de        ");
                          lcd.setCursor(0, 3);
                          lcd.print("Proxima Votacion    ");
                          print1=1;
                          //variable=0;
                          }
                          delay(500);
                          }
                        
                      }else{
                          if (print2==0){
                          Serial.println("En espera de Proxima Votación");
                          lcd.setCursor(0, 2);                    
                          lcd.print("En espera de        ");
                          lcd.setCursor(0, 3);
                          lcd.print("Proxima Votacion    ");
                          print2=1;
                          }
                          delay(500);
                          //variable=0;
                          }
            
            
  
  
  
  
  
  
  
  
}

  
}
