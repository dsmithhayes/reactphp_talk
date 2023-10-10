# ReactPHP

_A practical use-case of a (not-so) novel PHP Library._

---

# Who Am I?

I am Dave Smith-Hayes. _(photo not found)_

* Software Developer for a Label Company
* PHP Knower
* Node.js Enjoyer
* C Apologist
* Offensive IPA Connoisseur

---

![bg width:750px](./my_php_meme.jpg)

---

# Yes.

---

# ReactPHP Overview

From their Website:

> ReactPHP is a low-level library for event-driven programming in PHP. At its core is an event loop, on top of which it provides low-level utilities, such as: Streams abstraction, async DNS resolver, network client/server, HTTP client/server and interaction with processes. Third-party libraries can use these components to create async network clients/servers and more. 

---

# ReactPHP Overview

Think Node.js, but in _pure PHP_.

* There is an [Event Loop](https://reactphp.org/event-loop/)
* There are [Streams](https://reactphp.org/stream/)
* There is [Async](https://reactphp.org/async/) and [Promises](https://reactphp.org/promise/)
* There is [a TCP Socket API](https://reactphp.org/socket/)
  * There is [an HTTP Server](https://reactphp.org/http/)!
* There is a [UDP Socket API](https://reactphp.org/datagram/)

---

# PHP As We Know it

Typical PHP setup:

* NGiNX
* PHP-FPM
* Lots of Configuration

---

# PHP As We Know It

> Diagram of the Client to server to FPM

---

# What is Async?

Based around an Event Loop. Letting the operating system handle things outside the main thread. waiting for the loop to come back around and handle the response from the OS.

Not necessarily parallelism though it can do that and does feel that way.

---

# Getting Started

```bash
$ composer require react/stream react/http react/promise
```

---

# HTTP Server in ReactPHP

> Example of the basic HTTP Server

---

# An Aside about PSR

* PHP Standards Recommendation
* Drafted, voted on by **PHP-FIG**
* Common Patterns Include:
  * Autoloading PHP Code (_PSR-1_)
  * HTTP Message Interfaces (_PSR-7_)
  * Logging Interfaces (_PSR-3_)
  * Container Interfaces (_PSR-11_)
  * Coding Style Guides (_PSR-1_)

---

# What is SlimPHP?

* A PHP Microframework for HTTP Applications
  * Think Express.js
  * Think Sinatra
  * Think Flask
* Uses a Middleware Interface
* Uses a Container Interface
* Lets you define routes with callbacks

## Installing

```bash
$ composer require slim/slim slim/psr7
```

---

# SlimPHP with ReactPHP

> Example of running SlimPHP and Handling Requests

---

# Why?

Why not?

---

# No, Seriously, Why?

* Reduced container image size
* Single process Container
* Leverages existing PHP libraries

---

# PHP-PM

I figured I should mention an actual project that uses ReactPHP to manage processes for different application frameworks like Laravel.

---

# FIN
