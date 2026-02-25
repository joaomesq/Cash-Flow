import os
import shutil
import subprocess
import sys

# pegando caminho raiz do projeto
project_path = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))

def rodar_comando(comando, cwd = None):
    """Executa comandos no terminal"""
    print(f"Executando: {comando}")
    subprocess.run(comando, cwd = cwd or project_path, check = True, shell = True)

def instalar_dependencias_php():
    #Instalando as dependência php via composer
    rodar_comando("docker compose exec app install")
    print("\nDependências php instaladas")

def instalar_dependencias_js():
    #Instalando dependências js via npm
    rodar_comando("npm install")
    print("\nDependências js instaladas")

def instalar_dependencias_python():
    """Pegando as dependências necessárias caso existam, do arquivo requiments.txt """
    req_path = os.path.join(project_path, "scripts", "requirementes.txt")
    # checkando a existência do requirements.txt
    if os.path.exists(req_path):
        print("\nInstalando dependências python")
        subprocess.run([sys.executable, "-m", "pip", "install", "-r"], req_path)
        print("\nDependências php instaladas")
    else:
        print("\nrequirements.txt não encontrado para python")

def instalar_dependencias():
    instalar_dependencias_php()
    #instalar_dependencias_js()
    instalar_dependencias_python()

def criar_arquivo_env():
    #apenas se não existir - criar a partir do .env.example
    env_file = os.path.join(project_path, ".env")
    env_example = os.path.join(project_path, ".env.example")

    if not os.path.exists(env_file):
        print("\nCriando arquivo .env")

        if os.path.exists(env_example):
            shutil.copy(env_example, env_file)
            
            print("\nArquivo .env criado a partir de .env.example")
        else:
            #caso não exista .env.example criar um básico
            print("\nNão foi encontrado .env.example, criando um básico")

            with open(env_file, "w") as file:
                print("\nNão foi encontrado arquivo .env.example, criando um básico")
                file.write("APP_NAME=SG-Yia\nAPP_ENV=local\nAPP_KEY=\nDB_CONNECTION=mysql\n")
                print("\nArquivo .env básico criado")
    else:
        print("\nArquivo .env já existe, pulando a criação")

def gerar_chave_laravel():
    #Gera chave da aplicação laravel
    print("\nCriando chave da aplicação")
    rodar_comando("docker compose exec app php artisan key:generate")
    print("\nChave da aplicação criada\n")

def run_migration(root_dir):
    print("\nExecutando as migrações e seeds")
    try:
        rodar_comando("docker compose exec app php artisan migrate")
        rodar_comando("docker compose exec app php artisan db:seed")
        print("\nMigrações e seeds executadas com sucesso")
    except:
        print("\nErro ao rodar as migrações, provavelmente o banco não está criado a variaveis de ambiente não foram configuradas, \n Faça manualmente")

def criar_link_simbolico():
    #Criar o link entre a pasta storage/app/public e a pasta public/storage
    print("\nCriando link simbólico")
    rodar_comando("docker compose exec app php artisan storage:link")
    print("\nLink Simbólico criado")

if __name__ == '__main__':
    print("Iniciando a configuração do projeto[Laravel]\n")
    instalar_dependencias()
    criar_arquivo_env()
    gerar_chave_laravel()
    run_migration(project_path)
    criar_link_simbolico()

    print("\nConfiguração concluída com sucesso!")