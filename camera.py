# Bibliotecas 
import cv2
import sys
import re
import requests
import time
from time import strftime,gmtime
from PIL import Image
 
def datahora(): #função para a hora
    time=strftime("%d-%m-%Y_%H;%M;%S",gmtime())
    return time
 
def send_file(nome): # funçao para dar post no site
    files = {'imagem': open(nome, 'rb').read()} # abre a imagem em bytes e guarda a informação na variavel files 
    r = requests.post('http://127.0.0.1/ProjetoEstufa/upload.php', files=files) # envia a imagem para o website
    if r.status_code == 200:  # verifica se foi bem feito
        print("OK: POST Realizado com sucesso")
    else:
        print("ERRO: Não foi possível realizar o pedido")
        print(r.status_code)

def porta():
    r1=requests.get('http://127.0.0.1/ProjetoEstufa/api/api.php?nome=porta') # vai buscar a informação sobre o radar ao website
    if r1.status_code == 200: # Verifica se o request foi feito com sucesso
        estado_porta=(int)(r1.text)
        return estado_porta
    else:
        print("O pedido HTTP não foi bem sucedido")


i=0

try:
    print("[CTRL+C]Terminar para terminar o programa")
    while True:
            estado_porta=porta()
            if estado_porta==1:
                r=requests.get('http://127.0.0.1/ProjetoEstufa/api/api.php?nome=webcam') # vai buscar a informação sobre o radar ao website
                if r.status_code == 200: # verifica se nao houve erro no request
                    if int(r.text)!=0:
                        i=int(r.text)+1
                    else:
                        i=1
                    print(i)
                    
                    data=datahora()
                    dados = {'nome': "webcam", 'valor': i, 'hora': data}
                    r1 = requests.post("http://127.0.0.1/projetoestufa/api/api.php?nome=webcam", dados)
                    
                    camera = cv2.VideoCapture(0, cv2.CAP_DSHOW)
                    ret, image = camera.read() # lê essa captura e guarda com o nome image
                    print ("Resultado da Camera=" + str(ret)) # mostra se correu bem a captura
                    cv2.imwrite('img/webcam'+str(i)+'.png', image) # altera o nome da imagem para o pretendido
                    size = 250, 250
                    
                    im = Image.open("img/webcam"+str(i)+".png") # abre a imagem anterior
                    im_resized = im.resize(size, Image.ANTIALIAS)
                    im_resized.save('img/webcam'+str(i)+'.png', "PNG") # altera a resoluçao da imagem
                    
                    camera.release()
                    
                    send_file("img/webcam"+str(i)+".png") # envia a imagem com o nome(nome_ultima) ou seja a ultima foto tirada
                    #cv2.destroyAllWindows() # fecha as janelas
                    #time.sleep(5) # pára o programa por 2 seconds
                    while True:
                        estado_porta=porta()
                        if estado_porta==0:
                            break
                else:
                    print("O pedido HTTP não foi bem sucedido")

except KeyboardInterrupt: # Caso seja o utilizador a interromper o programa com "CTRL+C"
    print("\nPrograma Abortado")            
except: # caso haja um erro qualquer
    print("Ocorreu um erro:", sys.exc_info() )
finally: # executa sempre, independentemente se ocorreu exception
    print("Fim do programa")