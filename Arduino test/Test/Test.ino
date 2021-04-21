// définition de la broche 2 de la carte en tant que variable
const int led_rouge1 = 7;
const int led_rouge2 = 6;
const int led_jaune1 = 5;
const int led_jaune2 = 4;
const int led_vert1 = 3;
const int led_vert2 = 2;
const int led_blanc = 8;


// fonction d'initialisation de la carte
void setup()
{
    // initialisation de la broche 2 comme étant une sortie
    pinMode(led_rouge1, OUTPUT);
    pinMode(led_rouge2, OUTPUT);
    pinMode(led_jaune1, OUTPUT);
    pinMode(led_jaune2, OUTPUT);
    pinMode(led_vert1, OUTPUT);
    pinMode(led_vert2, OUTPUT);
    pinMode(led_blanc, OUTPUT);
}

// fonction principale, elle se répète (s’exécute) à l'infini
void loop()
{
    // contenu de votre programme
    digitalWrite(led_rouge1, LOW);
    delay(10);
    digitalWrite(led_rouge2, LOW);
    delay(10);
    digitalWrite(led_jaune1, LOW);
    delay(10);
    digitalWrite(led_jaune2, LOW);
    delay(10);
    digitalWrite(led_vert1, LOW);
    delay(10);
    digitalWrite(led_vert2, LOW);
    delay(10);
    digitalWrite(led_blanc, LOW);
    delay(10);

    digitalWrite(led_rouge1, HIGH);
    delay(10);
    digitalWrite(led_rouge2, HIGH);
    delay(10);
    digitalWrite(led_jaune1, HIGH);
    delay(10);
    digitalWrite(led_jaune2, HIGH);
    delay(10);
    digitalWrite(led_vert1, HIGH);
    delay(10);
    digitalWrite(led_vert2, HIGH);
    delay(10);
    digitalWrite(led_blanc, HIGH);
    delay(10);
}
