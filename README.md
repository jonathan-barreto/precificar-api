# PRECIFICAR API

## Configuração Inicial

1. php artisan migrate

2. php artisan db:seed

## Iniciando o Servidor PHP 

Para iniciar o servidor PHP usando o Artisan e torná-lo acessível em todas as interfaces de rede, siga estas etapas:

1. Abra um terminal no diretório do seu projeto Laravel.

2. Execute o seguinte comando:

    ```bash
    php artisan serve --host=0.0.0.0
    ```

3. O servidor será iniciado e estará acessível em todas as interfaces de rede.

4. Você pode acessar seu aplicativo Laravel a partir de outros dispositivos na mesma rede usando o endereço IP da máquina que está executando o servidor PHP e a porta padrão `8000`. Por exemplo:

    ```bash
    http://SEU_ENDERECO_IP:8000
    ```

Lembre-se de substituir `SEU_ENDERECO_IP` pelo endereço IP real da máquina que está executando o servidor PHP.

Certifique-se de fornecer informações adicionais, como a necessidade de ter o PHP instalado, e ajuste conforme necessário para atender às especificidades do seu projeto.

## Obter lista de Usuários

**Endpoint:** `GET api/list-users/{user_id}`

**Descrição:**

Esta rota lista os usuários com stories mais recentes, ordenados pelo story mais recente de cada usuário. A lista é filtrada para incluir apenas usuários com stories que ainda não expiraram.

**Parâmetros:**
- `user_id` : O ID do usuário para o qual os stories serão recuperados.

**Exemplo de Uso:**
- `GET api/my-stories/1`

**Resposta de Exemplo**

```http
{
  "current_user": {
    "id": 1,
    "name": "Usuário Atual",
  },
  "users": [
    {
      "id": 2,
      "name": "Usuário 1",
    },
    // Outros users...
  ]
}
```

## Obter Stories de um Usuário

**Endpoint:** `GET /my-stories/{user_id}`

**Descrição:**
Esta rota é responsável por obter os stories de um usuário específico com base no `user_id`. Retorna uma lista dos stories do usuário, filtrados por aqueles que ainda não expiraram.

**Parâmetros:**
- `user_id` : O ID do usuário para o qual os stories serão recuperados.

**Exemplo de Uso:**
- `GET api/my-stories/1`

**Resposta de Exemplo**

```http
{
  "stories": [
    {
      "id": 1,
      "user_id": 123,
      "path_image_story": "story1.jpg",
      "subtitle_story": "Lorem ipsum...",
      "expiration_date": "2023-11-20 12:00:00",
      "created_at": "2023-11-18 08:30:00",
      "updated_at": "2023-11-18 08:30:00"
    },
    // Outros stories...
  ]
}
```

## Criação de story

**Endpoint:** `POST api/create-story`

**Descrição:**

Esta rota permite que os usuários façam upload do seu story por meio do envio de uma imagem. A imagem é salva no sistema de arquivos, e as informações do story são registradas no banco de dados.

**Parâmetros:**
- `user_id` (body): O ID do usuário que está fazendo o upload.
- `image` (arquivo): A imagem a ser enviada.

**Exemplo de Uso:**

- `POST api/create-story`

**Resposta de Exemplo**

```http
{
  "message": "Upload do story foi concluído com sucesso!"
}
```
