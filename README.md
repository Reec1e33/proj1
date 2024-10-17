# Web Server Project for reeceroskam.com

## Project Overview
This repository hosts the project files for my personal website hosted at `reeceroskam.com` and `dev.reeceroskam.com`. The project involves a multi-instance AWS setup with a load balancer, web server, and a development server. The web server serves HTML and PHP files with automated deployments from the development server using a custom Git workflow.

## Project Structure
- **Dev Server** (`dev.reeceroskam.com`): Hosts development files and pushes code to the web server via Git.
- **Web Server** (`reeceroskam.com`): Hosts the main website files, including static assets and API endpoints.
- **Load Balancer**: Routes HTTP and HTTPS traffic to the web server.

## Setup and Workflow

### 1. Git Workflow
- **Development Server**: Code is written on the development server (`dev.reeceroskam.com`) and pushed to the web server via Git.
  - Commands used:
    ```bash
    git add <files>
    git commit -m "message"
    git push webserver main
    ```

- **Web Server**: A bare Git repository (`/var/repo/reeceroskam.git`) on the web server handles incoming pushes. A `post-receive` hook automatically checks out the files to the web server’s root directory (`/var/www/reeceroskam.com`).
  - Manual Deployment (if necessary):
    ```bash
    GIT_WORK_TREE=/var/www/reeceroskam.com git checkout -f main
    ```

### 2. File Structure
Key files and directories on the web server:
- `/var/www/reeceroskam.com/html/`: Contains all public-facing HTML, CSS, and JavaScript files.
- `/home/reece/projects/proj1/`: Development project directory for `dev.reeceroskam.com`.
- `/var/repo/reeceroskam.git/`: Bare Git repository used for deploying files from the development server.

### 3. Security and Permissions
- **SSH Access**: Only the development server’s security group can SSH into the web server.
- **Permissions**: Files on the web server are owned by `reece:webgroup` and have `770` permissions to ensure secure access.
  - Commands used to set permissions:
    ```bash
    sudo chown -R reece:webgroup /var/www/reeceroskam.com
    sudo chmod -R 770 /var/www/reeceroskam.com
    ```

### 4. Load Balancer and HTTPS Setup
- **Load Balancer**: Routes HTTPS traffic using an SSL certificate (set up on the load balancer) and forwards it as HTTP to the web server. The web server only accepts HTTP traffic on port 80.
- **Security Groups**: Configured to allow inbound HTTP/HTTPS traffic to the load balancer, with the web server allowing inbound HTTP traffic from the VPC CIDR block.

### 5. PostgreSQL Integration
This project stores app request data in a PostgreSQL database hosted on a separate DB server. This setup minimizes costs by storing and pulling data from the database, reducing unnecessary API calls.

### 6. C++ Integration
The web server is configured to eventually support C++ programs and projects, allowing C++ code integration with the website. This includes creating React-based file names like `src` and `public`.

## Future Plans
- Extend the current setup to support an additional subdomain, `chatgpt.reeceroskam.com`, for an AJAX-based API endpoint.
- Continue integrating C++ programs with dynamic web features.
