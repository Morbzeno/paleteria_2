# def procesar_archivo(nombre_archivo):
#     with open(nombre_archivo, 'r') as archivo:
#         contenido = archivo.read()
#     return contenido


# archivo = input("Ingrese el nombre del archivo a procesar: ")
# print(procesar_archivo(archivo))



# def calcular(operacion):
#       return eval(operacion)

# entrada =  "__import__('os').system('cmd /c echo hackeado!')"
# print("resultado", calcular(entrada))



# import ast
# def calcular_seguro(operacion):
#     try:
#         tree = ast.parse(operacion, mode='eval')
#         for node in ast.walk(tree):
#             if not isinstance(node,(ast.Expression, ast.BinOp, ast.Constant,ast.unaryop)):
#                 raise ValueError("operacion no permitida")
#         return eval(compile(tree, filename="", mode = "eval"))
#     except Exception as e:
#         return f"Error:{str(e)}"
    
# entrada =  "__import__('os').system('cmd /c echo hackeado!')"
# print("resultado", calcular_seguro(entrada))



# def dividir(a,b):
#     return  a / b

# try:
#     resultado = dividir(10,0)
# except Exception as e:
#     print(f"Error:{e}")



# def dividir_seguro(a,b):
#     try:
#         return a / b
#     except ZeroDivisionError:
#         return "Error: no se puede dividir entre 0"
#     except Exception:
#         return "Error: Ocurrio un problema al realizar la operacion"
   
# print(dividir_seguro(10,0))



# def cargar_archivo(ruta):
#       archivo = open(ruta,"r")
#       return archivo.read()
# ruta_usuario = "C:\\Users\\User\\intento1\\archivo.txt"

# contenido = cargar_archivo(ruta_usuario)
# print(contenido)



def cargar_archivo_seguro(ruta):
      try:
            archivo = open(ruta, "r")
            return archivo.read()
      except FileNotFoundError:
            return "Error: el archivo solicidado no esta disponible"
      except Exception:
            return "Error, algo ourrio al ejecutar el proceso"    
ruta_usuario = "C:\\Users\\User\\intento1\\archivo.txt"
print(cargar_archivo_seguro(ruta_usuario))
