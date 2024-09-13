def binary_search(arr, low, high, x):
    if (high >= low):
        mid = (high + low) // 2
        if arr[mid] == x:
            return mid
        elif arr[mid] > x: 
            return binary_search(arr, low, mid - 1, x)
        else:
            return binary_search(arr, mid + 1, high, x)
    else:
        return -1

def solve():
    arr = (input("Enter element: "). split())
    arr_list = list()
    for numb in arr: 
        arr_list.append(int(numb))

    print(arr)
    x = int(input("Element searched: "))
    print(binary_search(arr_list, 0, len(arr_list) - 1, x) + 1)

if __name__ == "__main__":
    solve()