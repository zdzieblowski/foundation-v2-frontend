# Foundation Front-end (v2)
A simple PHP front-end for Foundation Server (v2)

> [!WARNING]
> Following instructions assume that you have a working knowledge of programming and systems administration.

## Installation
1. Install, configure and run the **[Foundation Server (v2)](https://github.com/blinkhash/foundation-v2-server)**.
2. Choose, install and configure a web server with **PHP** and **cURL** support.
4. Configure an virtual host and unpack the contents of this repository's ``src/`` directory to its document root.
5. Proceed to front-end configuration.

## Front-end configuration

### Common configuration
Configuration for all common settings of the front-end are stored in the file ``common/configuration.php``.

### Pool configuration
Configuration for pool specific settings are stored by default in separate folders in the ``configurations/`` directory.
> [!TIP]
> To disable a pool configuration remove its folder with all its contents.

### Templates
> [!CAUTION]
> The only currently available template is copyrighted by [TMS](https://themining.site) for whom this front-end was initially developed.\
> \
> **There will be an template available in the future that will not contain any copyrighted material.**\
> Until then please develop your own templates using files contained in this repository as a base and inspiration.\
> \
> *I case you will develop an universal template that you wish to share with others please submit it via a pull request.*

Template files are by default stored in separate forders in the ``templates/`` directory.\
Templates contain everything that defines the look and feel of this front-end and can be configured and modified to a high degree to meet your specifications.

## Usage
If installed and configured properly the front-end should be accessible from any web browser at the address you defined in your virtual host's configuration.

## Community
Please forgive the current state of this instruction manual and in case of any questions, suggestions or comments feel free to submit an issue or pull request. 
