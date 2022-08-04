#include <NTPClient.h>

/* Read RFID Tag with RC522 RFID Reader
 *  Made by miliohm.com
 */

 
#include <SPI.h>
#include <MFRC522.h>

constexpr uint8_t RST_PIN = D3;     // Configurable, see typical pin layout above
constexpr uint8_t SS_PIN = D4;     // Configurable, see typical pin layout above

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

String tag;

/// LCD --------------------------------------------------------------------------
#include <Wire.h> // responsável pela comunicação com a interface i2c
#include <LiquidCrystal_I2C.h> // responsável pela comunicação com o display LCD
// Inicializa o display no endereço 0x27
//os demais parâmetros, são necessários para o módulo conversar com o LCD
//porém podemos utilizar os pinos normalmente sem interferência
//parâmetro: POSITIVE > > Backligh LIGADO | NEGATIVE > > Backlight desligado
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);

/// LCD --------------------------------------------------------------------------


void setup() {
  Serial.begin(9600);
  SPI.begin(); // Init SPI bus
  rfid.PCD_Init(); // Init MFRC522
  Serial.println("Lector de TAG RFID");
  lcd.begin(16, 2); // Setup LCD 16x2
  lcd.print("   Conectando...");
}

void loop() {
  if ( ! rfid.PICC_IsNewCardPresent())
    return;
  if (rfid.PICC_ReadCardSerial()) {
    for (byte i = 0; i < 4; i++) {
      tag += rfid.uid.uidByte[i];
    }
    lcd.clear();
    Serial.print("TAG: ");
    Serial.println(tag);
    lcd.setCursor(0, 0);
        lcd.print("TAG");
        lcd.print(": ");
        lcd.print(tag);
    tag = "";
    rfid.PICC_HaltA();
    rfid.PCD_StopCrypto1();
  }
}
