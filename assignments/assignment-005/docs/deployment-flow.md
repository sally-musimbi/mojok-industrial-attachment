# Nexora Website Deployment Flow

```mermaid
flowchart TD
    A[Visitor Browser] --> B[DNS / Local Hosts Entry]
    B --> C[Ubuntu Test Server - WSL2]
    C --> D[Apache Web Server]
    D --> E{Connection Type}
    E -->|HTTP Port 80| F[nexora.conf]
    E -->|HTTPS Port 443| G[nexora-ssl.conf]
    G --> H[TLS Certificate]
    F --> I[Document Root: /var/www/nexora]
    H --> I
    I --> J[HTML Pages]
    I --> K[CSS and JavaScript Assets]
    J --> L[Website Displayed in Browser]
    K --> L
```
## Explanation

1. The visitor enters `nexora.local` in a browser.
2. The local hosts configuration resolves the hostname.
3. The request reaches the Ubuntu WSL2 test environment.
4. Apache selects the matching virtual host.
5. HTTP uses port 80; HTTPS uses port 443 and TLS.
6. Apache serves the website from `/var/www/nexora`.
7. The browser displays the HTML pages and supporting assets.
