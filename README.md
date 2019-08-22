# Calculator

## Why?

This repository is designed as an example of how you can implement a 
calculator based on abstract syntax tree generated by the LL(k) recurrence 
recursive descent parser.

As a grammar used the basic implementation with operators associativity, and 
not vulnerable to left recursion:

```ebnf
<expr>           ::= <addition> | <subtraction> | <term>

<term>           ::= <multiplication> | <division> | <factor>
<factor>         ::= "(" <expr> ")" | <value>

<subtraction>    ::= <term> "-" <expr>
<addition>       ::= <term> "+" <expr>
<multiplication> ::= <factor> "*" <term> | <factor> <term>
<division>       ::= <factor> ("/" | "÷") <term>

<value>          ::= T_FLOAT | T_INT
```

Where 
- `T_INT` is a PCRE `[0-9]+` 
- `T_FLOAT` is a PCRE `[0-9]+\.[0-9]+`

## Example

Command Line Interface

```bash
$ php ./bin/cc
```

![](https://habrastorage.org/webt/mp/d7/ps/mpd7pstl7eda-3ntjsvuz6aho_o.png)

## Usage

**Global:**

```bash
$ composer global require serafim/calc
$ cc
```

**Local:**

```bash
$ composer require serafim/calc
$ ./vendor/bin/cc 
```

