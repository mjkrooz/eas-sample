# EAS Code Sample: Source Block

## Description

Source Block is a long-standing personal project of mine, written in PHP. Its intention is to be a large collection of tools (to create and validate data/scripts) and information (raw data as well as usage guides) to help players create custom content in Minecraft. While still in very early stages of development, it utilizes a wide variety of technologies and techniques that help serve as a proper code sample. The site has a live demo at [https://sourceblock.net](https://sourceblock.net).

### Other Repositories

While the source code for it is not openly available given it is deep within early development, there is a suite of PHP libraries (**also created by me and so is subject for review** (and may be easier to navigate, of course)) used within Source Block's user tools. The libraries include:

1. Base auditing library: https://github.com/celestriode/constructure
1. Generic JSON auditing: https://github.com/celestriode/constructure-json
1. Minecraft's target-selector auditing: https://github.com/celestriode/constructure-target-selector
1. Minecraft-specific JSON auditing built on top of generic JSON auditing: https://github.com/celestriode/constructures-minecraft
1. Parsing library for Minecraft's NBT storage format and target selectors: https://github.com/celestriode/mattock
1. Base dynamic registries library: https://github.com/celestriode/dynamic-registry
1. Minecraft-specific dynamic registries (to validate Minecraft-specific data): https://github.com/celestriode/dynamic-minecraft-registries

These particular libraries can be seen in action in the [Text Component Evaluator](https://sourceblock.net/beta/en-US/tools/data-packs/text-component-evaluator) tool. It takes JSON as an input and validates its structure for use within Minecraft's text display engine. If there are issues, the user is provided with information on how to remedy them. The following sample inputs can be used to see varying results, noting that clickable context is provided to help the user narrow down issues:

- Invalid: `{}`
- Valid: `"hello world"`
- Valid: `{"text": "hello world"}`
- Invalid: `{"text": "hello world", "keybind": "invalid"}`
- Invalid: `{"score": 123}`
- Valid: `["a", {"text": "hello world"}]`
- Recursive sample: `[[[[{"invalid": "hello world"}]], {}]]`

# Source Code

## PHP & Libraries

The version of PHP being used is PHP 8.0.30.

The website is built off of the [Laravel](https://laravel.com/) framework primarily to use its routing and templating features. It follows the [LucidArch](https://docs.lucidarch.dev/concept/) architecture for domain-driven design to help with flow in what is intended to become a large and complex application. See the `MYFILES.md` for a list of files that were created/modified by me.

[Composer](https://getcomposer.org/) is used as the dependency manager for PHP.

## JavaScript & Libraries

The front-end uses the [Vue.js](https://vuejs.org/) JavaScript library, using Node Package Manager for dependencies. Note that the front-end does not use front-end routing in the form of a Single-Page-Application. The primary use of Vue.js is in tools on the website, to aid in the user experience.

### Raycasting Generator

The primary tool that uses Vue.js in this case is the [Raycasting Generator](https://sourceblock.net/beta/en-US/tools/data-packs/raycasting-generator).

Source files are located at:

- Controller: `/src/App/Services/Tools/Http/Controllers/RaycastingGeneratorController.php`
- Primary view: `/src/App/Services/Tools/resources/views/pages/generators/raycasting.blade.php`
- API Controller: `/src/App/Services/ApiV1/Http/Controllers/ToolsController.php`
- JavaScript front-end: `/src/resources/js/tools/generators/raycasting/raycasting`
- PHP back-end:
    - View page: `/src/App/Services/Tools/Features/ViewRaycastingGeneratorFeature.php`
    - Generate result: `/src/App/Services/Tools/Features/GenerateRaycastDataPackFeature.php`

## CSS & Libraries

The website's CSS is built around the [Boostrap CSS framework](https://getbootstrap.com/).

# Architecture

## Apache2

The underlying HTTP server is Apache2. [Let's Encrypt](https://letsencrypt.org/) is used for TLS encryption.

## Live Demo Architecture

The live demo is hosted on [DigitalOcean](https://www.digitalocean.com/). The domain name was originally obtained through Google Domains, which has since been discontinued. The domain was transferred to [Porkbun](https://porkbun.com/).

## Development Website Architecture

The development server is locally hosted on a Dell R240 rack server. The server has the [Proxmox](https://www.proxmox.com/) hypervisor installed, which is then running an Ubuntu 20.04 machine that is hosting the development website. A [GitLab](https://about.gitlab.com/) virtual machine also exists to act as a local code repository.

# Future Goals

Apart from continuing development, which had become stagnant during my schooling, I have a primary goal of improving the architecture.

- For ease of development in local environments, I would like to switch to using Docker containers. This would include a MySQL container for when development has advanced far enough to require its use.
- To improve upon security standing for the eventual live website, I would prefer to have a web proxy that sits in the DMZ and the actual web server locked into its own LAN, whose only communication can be HTTP/HTTPS traffic through the proxy. This would also provide an easier opportunity to implement load balancing as needed, as well as a proper Web Application Firewall.
- Automate Minecraft registry population locally. Currently, a third-party repository is used for populating Minecraft data. Local and automatic population is possible through interaction with the Minecraft JAR using Java, which can provide the same data but in a more controlled environment.
- Switch to memcached for faster cache access.