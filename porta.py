# Bibliotecas 
from time import (strftime, gmtime)
from msvcrt import (kbhit, getch)
import requests

def datahora(): #Função que vai buscar a data e a hora ao sistema
    s = strftime("%Y-%m-%d %H:%M:%S")
    return s


def send_to_api(dataHora, dados): # Função que altera o valor da porta na API e que vai ter impacto na Dashboard e no Packet Tracer
    r = requests.post("http://127.0.0.1/projetoestufa/api/api.php?nome=porta", dados) # Dá POST da informação na API
    if r.status_code == 200: # Verifica se o método POST foi realizado com sucesso
        print("\nOK: POST realizado com sucesso")
        print(r.status_code)
    else:
        print("\nERRO: Não foi possivel realizar o pedido")
        print(r.status_code)


try:

    tecla_auxiliar = -1 #Variável Auxiliar
    print("Menu Porta:\n (0) Fechar Porta\n (1) Abrir Porta\n[CTRL+C]Terminar para terminar o programa") # Menu Porta
    while True:
        if kbhit(): # Fica verdadeiro se uma tecla é pressionada
            tecla = getch() # Vai buscar o valor dessa tecla
            dataHora = datahora() # Vai á função datahora() buscar a Hora/Dia
            if tecla_auxiliar != int(tecla): # Verifica se a tecla pressionada é diferente
                if int(tecla) == 1: 
                    dados = {'nome': "porta", 'valor': "1", 'hora': dataHora} # Guarda os dados necessarios na vetor dados
                    send_to_api(dataHora, dados) # Vai a função send_to_api
                    print("\nA Porta foi aberta")
                    tecla_auxiliar=int(tecla) # Substitui a tecla auxiliar por 1 o que significa que a porta está aberta
                elif int(tecla) == 0:
                    dados = {'nome': "porta", 'valor': "0", 'hora': dataHora} # Guarda os dados necessarios na vetor dados
                    send_to_api(dataHora, dados) # Vai a função send_to_api
                    print("\nA Porta foi fechada")
                    tecla_auxiliar=int(tecla) # Substitui a tecla auxiliar por 0 o que significa que a porta está fechada
                else:
                    print("\nOpcão Inválida")
            else: # Caso tecla pressionada seja igual á anterior
                if(tecla_auxiliar==0):
                    print("\nA Porta já estava fechada\n")
                else:
                    print("\nA Porta já estava aberta\n")
except KeyboardInterrupt: # Caso seja o utilizador a interromper o programa com "CTRL+C"
    print("\nPrograma Abortado")
except:
    print("\nOcorreu um erro")
finally:  # Executa sempre, independentemente se ocorreu exception
    print("Fim do Programa")
