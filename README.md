# Stratta Consulting Website

## Português

### Visão geral
O projeto do site corporativo da Stratta Consulting foi organizado como uma landing page institucional responsiva, com foco em apresentar a marca, os serviços e os pontos de diferenciação da empresa. A estrutura atual é composta por páginas estáticas em HTML, com um formulário de contato integrado em PHP/PHPMailer.

### Páginas principais
- index.html — página inicial com apresentação institucional e chamadas para ação
- sobre.html — página sobre a empresa e sua abordagem
- execsearch.html — recrutamento de executivos
- assessment.html — assessment corporativo
- coaching.html — coaching executivo
- conselho.html — conselho consultivo
- contato.html — formulário de contato
- agradecimento.html — página de confirmação após envio do formulário
- privacidade.html — política de privacidade
- terms.html — termos de uso

### Estrutura do projeto
- css/style.css — estilos principais do site
- js/main.js — interações, navegação e animações do frontend
- mail/contact.php — processamento do formulário de contato
- PHPMailer/ — biblioteca para envio de emails via SMTP
- img/ — imagens otimizadas em AVIF/WEBP com fallback para PNG/JPG
- lib/ — bibliotecas de terceiros utilizadas em animações e carrosséis
- package.json — dependências e scripts de build do projeto
- webpack.config.js — configuração de otimização de assets
- config.php — configurações sensíveis do envio de email (não deve ser compartilhado publicamente)

### Como executar localmente
1. Coloque a pasta do projeto em um ambiente local como XAMPP/WAMP.
2. Inicie o Apache e, se necessário, o MySQL.
3. Acesse o projeto pelo navegador usando o caminho local correspondente à pasta do site.
4. Para testar o formulário de contato, ajuste as configurações SMTP em config.php.

### Observações
- O site é voltado principalmente para o conteúdo em português.
- A identidade visual usa uma abordagem corporativa e moderna, com foco em performance e responsividade.
- As imagens foram organizadas para melhor desempenho em dispositivos diferentes.

---

## English

### Overview
The Stratta Consulting corporate website project is organized as a responsive institutional landing page, focused on presenting the brand, services, and key differentiators of the company. The current structure is composed of static HTML pages, with a contact form integrated through PHP and PHPMailer.

### Main pages
- index.html — homepage with institutional presentation and calls to action
- sobre.html — about page with company background and approach
- execsearch.html — executive search service
- assessment.html — corporate assessment service
- coaching.html — executive coaching service
- conselho.html — advisory council page
- contato.html — contact form page
- agradecimento.html — confirmation page after form submission
- privacidade.html — privacy policy page
- terms.html — terms of use page

### Project structure
- css/style.css — main site stylesheet
- js/main.js — frontend interactions, navigation and animations
- mail/contact.php — contact form processing logic
- PHPMailer/ — email delivery library via SMTP
- img/ — optimized AVIF/WEBP images with PNG/JPG fallback
- lib/ — third-party libraries used for animations and sliders
- package.json — project dependencies and build scripts
- webpack.config.js — asset optimization configuration
- config.php — sensitive email transport settings (should not be shared publicly)

### How to run locally
1. Place the project folder in a local environment such as XAMPP/WAMP.
2. Start Apache and MySQL if required.
3. Open the project in the browser through the local path for the website folder.
4. To test the contact form, update the SMTP settings in config.php.

### Notes
- The website is currently focused on Portuguese content.
- The visual identity follows a modern corporate style with emphasis on responsiveness and performance.
- Images were organized to improve loading speed across different devices.
