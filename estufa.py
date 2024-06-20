# Bibliotecas 
import time
from time import (strftime, gmtime)
from msvcrt import (kbhit, getch)
import requests


def datahora(): #Função que vai buscar a data e a hora ao sistema
    s = strftime("%Y-%m-%d %H:%M:%S")
    return s

def Temperatura():
    r=requests.get("http://127.0.0.1/ProjetoEstufa/api/api.php?nome=temperatura") # Request para saber o valor da temperatura
    if r.status_code == 200: # Verifica se o request foi feito com sucesso
            data=datahora()
            print("Temperatura: ", r.text,data)
    else:
        print("O pedido HTTP não foi bem sucedido")

def Humidade():
    r=requests.get("http://127.0.0.1/ProjetoEstufa/api/api.php?nome=humidade") # Request para saber o valor da humidade
    if r.status_code == 200: # Verifica se o request foi feito com sucesso
            data=datahora()
            print("Humidade: ",r.text,data)
            time.sleep(2)
    else:
        print("O pedido HTTP não foi bem sucedido")

def Agua():
    r=requests.get("http://127.0.0.1/ProjetoEstufa/api/api.php?nome=agua") # Request para saber o valor da agua
    if r.status_code == 200: # Verifica se o request foi feito com sucesso
            data=datahora()
            print("Água: ",r.text ,data)
            time.sleep(2)
    else:
        print("O pedido HTTP não foi bem sucedido")

def Fumo():
    r=requests.get("http://127.0.0.1/ProjetoEstufa/api/api.php?nome=fumo") # Request para saber o valor do fumo
    if r.status_code == 200: # Verifica se o request foi feito com sucesso
            data=datahora()
            print("Fumo: ",r.text ,data)
            time.sleep(2)
    else:
        print("O pedido HTTP não foi bem sucedido")

def Luminosidade():
    r=requests.get("http://127.0.0.1/ProjetoEstufa/api/api.php?nome=luminosidade") # Request para saber o valor da luminosidade
    if r.status_code == 200: # Verifica se o request foi feito com sucesso
            data=datahora()
            print("Luminosidade: ",r.text,data)
            time.sleep(2)
    else:
        print("O pedido HTTP não foi bem sucedido")


try:
    print("Menu\n (1) Temperatura\n (2) Humidade\n (3) Água\n (4) Fumo\n (5) Luminosidade\n[CTRL+C]Terminar para terminar o programa\n")
    while True: # Ciclo infinito só para quando for pressionado "CTRL+C"
            tecla = int(input(""))
            if tecla  == 1:
                Temperatura()
            elif tecla  == 2:
                 Humidade()
            elif tecla  == 3:
                 Agua()
            elif tecla  == 4:
                 Fumo()
            elif tecla  == 5:
                 Luminosidade()
            else:
                print("\nOpcão Inválida")

except KeyboardInterrupt:  # Caso seja o utilizador a interromper o programa com "CTRL+C"
    print("Programa terminado pelo utilizador")
except:
    print("Ocorreu um erro:")
finally: # Executa sempre, independentemente se ocorreu exception
    print("Fim do programa")