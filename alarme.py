# Bibliotecas 
from playsound import playsound 
import sys
import time
import requests

try:
    print("Prima CTRL+C para terminar")
    while True: # Ciclo infinito só para quando for pressionado "CTRL+C"
        r=requests.get("http://127.0.0.1/ProjetoEstufa/api/api.php?nome=alarme") # Request para saber o valor do Alarme
        if r.status_code == 200: # Verifica se o request foi feito com sucesso
            if float(r.text) == 1: # Se o Alarme estiver ativado mostra uma mensagem e ativa o som do Alarme
                print("\nPERIGO FOGO !!!")
                playsound('alarme_som.mp3') # Toca o som do Alarme
                time.sleep(2)
            else: # Se o Alarme estiver desativado mostra uma mensagem de que é seguro
                print ("\nSeguro")
                time.sleep(2)
        else:
            print("O pedido HTTP não foi bem sucedido")
except KeyboardInterrupt:  # Caso seja o utilizador a interromper o programa com "CTRL+C"
    print("Programa terminado pelo utilizador")
except:
    print("Ocorreu um erro:", sys.exc_info() )
finally: # Executa sempre, independentemente se ocorreu exception
    print("Fim do programa")
