# Send me your position

A shortcode that adds a button that allows your visitors to send to you their position via WhatsApp (using [wa.me](https://wa.me)).

## Why... and how it works

Have to go to your not much technology-savvy customer?
Point her/him to the page where the shortcode lives (maybe using a smartphone :-).
They will be guided through WhatsApp API to send you a message with a Google Maps link.
The script can also prompt for a name that will be sent in the message.

## Usage
```
[smyp wa="+1 555 4567" askname=1]button text[/smyp]
```
- Enclose the message you want to show in the shortcode.
- **Specify your phone number** in international format with "wa" parameter.
- Set askname=0 if you don't want the plugin to ask their name

| parameter | use                                               | example          | mandatory |
| --------- | ------------------------------------------------- | ---------------- | --------- |
| wa        | you WhatsApp phone number in international format | wa="+1 555 4567" | yes       |
| askname   | Prompt for a name? (default 1)                    | askname=0        | no        | 


## GDPR
To help us know the number of active installations of this plugin, we collect and store anonymized data when the plugin check in for updates. The date and unique plugin identifier are stored as plain text and the requesting URL is stored as a non-reversible hashed value. This data is stored for up to 28 days.

## What it does not does not do
- Open in a new window (that's for prevent Chrome to block like a popup).
- Send the message via WhatsApp. It only prepares it.
- Deal with WhatsApp Business API.

## Styling
Personalize your button with these CSS selectors.

| selector                   | function                    |
| -------------------------- | ----------------------------|
| `.smyp-container`          | for the main container      |
| `.smyp-button`             | for the button itself       |
| `.smyp-button-wa:before`   | for the WhatsApp icon       |
| ` #smyp-message`           | for the message container   |
| `.smyp-warn`               | for warning messages        |
| `.smyp-error`              | for error messages          |

-----
[Gieffe edizioni](https://www.gieffeedizioni.it) made this with ♥ for [ClassicPress](https://www.classicpress.net).