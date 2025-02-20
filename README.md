# Teste Objective 🕵🏼
> Primeiramente obrigado pela oportunidade, espero que gostem do projeto!


Abaixo estão alguns tópicos necessários para rodar o ambiente e alguns para informação sobre o teste.


## Requisitos: 👨🏼‍🔧
- docker
- docker-compose


## Installation 💪🏻
Linux:

```sh
docker compose up -d
```
Se quiser rodar sem o -d espere até aparecer a informação de que o servidor foi iniciado na porta 8000, ela está mapeada para a 8081 do computador.


## Mapa mental 👓

Aqui um desenho do que havia planejado antes de começar a mexer no código.

<img src="https://drive.google.com/file/d/1uML30nhLbQMkdO6L83vq7RAOu7RuCfCI/view?usp=drive_link">

## Cobertura de testes 🦺
Infelizmente não consegui cobrir tudo a tempo, mas cobri as principais ações.

<img src="https://drive.google.com/file/d/1fNPYgvJy7dk6A8p4tXfMI-DeXjVgqtOJ/view?usp=sharing">


## Endpoints
| Parâmetro                 | Método | Descrição               |
|---------------------------|--------|-------------------------|
| `/conta`                  | `POST` | Criar conta.            |
| `/transacao`              | `POST` | Realizar uma transação. |
| `/conta?numero_conta=234` | `GET`  | Buscar conta.           |

# POST /conta
```
paylod de envio

{
	"numero_conta": 97,
	"saldo": 40.76
}
```

# GET /conta?nome_conta=234
```

```

# POST /transacao
```
paylod de envio

{
	"forma_pagamento": "P",
	"numero_conta": 774,
	"valor": 229.40
}
```

## Agradecimentos

Obrigado de novo pela oportunidade, tenham um ótimo dia! 😊
