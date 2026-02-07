def procesar_archivo(nombre_archivo):
    with open(nombre_archivo, 'r') as archivo:
        contenido = archivo.read()
    return contenido


archivo = input("Ingrese el nombre del archivo a procesar: ")
print(procesar_archivo(archivo))