# Calculator

## Why?

This repository is designed as an example of how you can implement a 
calculator based on abstract syntax tree generated by the LL(k) recurrence 
recursive descent parser.

As a grammar used the basic implementation with operators associativity, and 
not vulnerable to left recursion:

```bnf
{
  tokens = [
    T_FLOAT = "regexp:\d+\.\d+"
    T_INT   = "regexp:\d+"
  ]
}

<expr>           ::= <addition> | <subtraction> | <term>

<term>           ::= <multiplication> | <division> | <factor>
<factor>         ::= "(" <expr> ")" | <value>

<subtraction>    ::= <term> "-" <expr>
<addition>       ::= <term> "+" <expr>
<multiplication> ::= <factor> "*" <term> | <factor> <term>
<division>       ::= <factor> ("/" | "÷") <term>

<value>          ::= T_FLOAT | T_INT
```

## Example

Command Line Interface

```bash
$ php ./bin/cc run
```

![image](https://user-images.githubusercontent.com/2461257/191113809-7a637fc2-71e0-48f7-a080-3998bab5edaa.png)

![image](https://user-images.githubusercontent.com/2461257/191683008-9566dc7e-5ff3-4648-b2e1-fddf35caf363.jpg)

## Usage

**Global:**

```bash
$ composer global require serafim/calc
$ cc run
```

**Local:**

```bash
$ composer require serafim/calc
$ ./vendor/bin/cc run
```

