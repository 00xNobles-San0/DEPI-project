VLAN Pentesting Simulation Project
Overview
This project simulates the network of an organization containing three VLANs. Each VLAN consists of different machines and challenges. The primary goal of this project is to perform penetration testing across these VLANs.
Machines Info 
https://drive.google.com/drive/folders/1jzpSPCATZt_oWtfqA2ei3JYst_O5t7VK
VLAN Structure
VLAN 1:

EZstart Machine:
Uploads any file type and returns the file path (e.g., shell_exectmp/imagename_timestamp.jpeg).
Exploited using a reverse shell to gain access.
Machine 1:
Access gained through EZstart’s reverse shell.
VLAN 2:

Bing Challenge Machine:
Executes input commands using shell_exec, bypassing escaped inputs.
Machine 2:
Access gained through Bing Challenge reverse shell.
VLAN 3:

Signup Page Machine:
Contains an upload feature vulnerable to SQL injection.
Allows PHP file uploads and retrieval paths for reverse shell execution.
VM-Scape Machine:
Hosts a vulnerable index.html page accepting POST requests in the format {“eqn”:”data”}.
Exploited using bypass methods for its equation parsing vulnerability.
Central Gateway
A routing machine acts as the central point of access between VLANs.
Steps for Penetration Testing
1. Network Scanning
Command: nmap -A -v -Pn -sV <target-ip>
Identify open ports and services.
2. Directory Enumeration
Command: gobuster dir -u <target-url> -w <wordlist>
Locate directories for further exploration.
3. SQL Injection on Signup Page
Exploit username and email fields to retrieve database information:
Use queries to bypass input validation.
Exploit the email field to retrieve file paths and execute reverse shells.
4. Privilege Escalation
Exploit misconfigurations like SUDOERS file access.
Use vulnerable applications or commands (e.g., nmap) for privilege escalation.
5. Exploiting Sandbox Vulnerabilities
Bypass regex-based input validation using obfuscated JavaScript (e.g., JSFuck).
Inject payloads into vulnerable functions like vm.run(eqn).
Tools Used
Nmap: For network scanning and discovery.
Gobuster: For directory enumeration.
SQLMap: For SQL injection automation.
Reverse Shell Scripts: To gain machine access.
JSFuck: To bypass input validation.
Results
Successfully compromised all VLAN machines.
Gained root access using privilege escalation.
Bypassed security mechanisms in sandboxed environments.
